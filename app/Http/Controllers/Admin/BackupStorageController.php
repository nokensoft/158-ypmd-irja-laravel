<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ZipArchive;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;

class BackupStorageController extends Controller
{
    private string $backupPath = 'backups/storage';

    public function index()
    {
        $backups = $this->getBackupFiles();
        return view('admin.backup-storage', compact('backups'));
    }

    public function create()
    {
        $sourcePath = storage_path('app/public');
        $storagePath = storage_path("app/{$this->backupPath}");

        if (!is_dir($storagePath)) {
            mkdir($storagePath, 0755, true);
        }

        $filename = 'backup_storage_' . date('Y-m-d_His') . '.zip';
        $zipPath = $storagePath . DIRECTORY_SEPARATOR . $filename;

        if (!is_dir($sourcePath)) {
            return redirect()->route('admin.backup-storage')
                ->with('error', 'Folder storage/app/public tidak ditemukan.');
        }

        $zip = new ZipArchive();
        $result = $zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        if ($result !== true) {
            return redirect()->route('admin.backup-storage')
                ->with('error', 'Gagal membuat file ZIP. Error code: ' . $result);
        }

        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($sourcePath, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::LEAVES_ONLY
        );

        $fileCount = 0;
        foreach ($files as $file) {
            if (!$file->isDir()) {
                // Skip dotfiles seperti .gitignore
                if (str_starts_with($file->getFilename(), '.')) {
                    continue;
                }

                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen(realpath($sourcePath)) + 1);
                // Normalize path separators for ZIP
                $relativePath = str_replace('\\', '/', $relativePath);
                $zip->addFile($filePath, $relativePath);
                $fileCount++;
            }
        }

        $zip->close();

        if ($fileCount === 0) {
            // Remove empty zip
            if (file_exists($zipPath)) {
                unlink($zipPath);
            }
            return redirect()->route('admin.backup-storage')
                ->with('error', 'Tidak ada file di folder storage untuk di-backup.');
        }

        return redirect()->route('admin.backup-storage')
            ->with('success', "Backup storage berhasil dibuat: {$filename} ({$fileCount} file)");
    }

    public function download(string $filename)
    {
        $filePath = storage_path("app/{$this->backupPath}/{$filename}");

        if (!file_exists($filePath)) {
            return redirect()->route('admin.backup-storage')
                ->with('error', 'File backup tidak ditemukan.');
        }

        return response()->download($filePath, $filename, [
            'Content-Type' => 'application/zip',
        ]);
    }

    public function restore(Request $request)
    {
        $request->validate([
            'zip_file' => 'required|file|mimes:zip|max:512000',
        ]);

        $file = $request->file('zip_file');
        $filePath = $file->getRealPath();

        if (empty($filePath) || !is_readable($filePath)) {
            return redirect()->route('admin.backup-storage')
                ->with('error', 'File ZIP tidak dapat dibaca.');
        }

        $targetPath = storage_path('app/public');

        $zip = new ZipArchive();
        $result = $zip->open($filePath);

        if ($result !== true) {
            return redirect()->route('admin.backup-storage')
                ->with('error', 'Gagal membuka file ZIP. Pastikan file valid.');
        }

        // Validasi isi ZIP — hanya izinkan file dengan ekstensi aman
        $allowedExtensions = [
            'jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'ico', 'bmp',
            'mp4', 'webm', 'avi', 'mov', 'mkv',
            'mp3', 'wav', 'ogg',
            'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'csv', 'txt',
            'zip', 'rar',
        ];

        for ($i = 0; $i < $zip->numFiles; $i++) {
            $entryName = $zip->getNameIndex($i);

            // Skip direktori
            if (str_ends_with($entryName, '/')) {
                continue;
            }

            // Skip dotfiles seperti .gitignore
            if (str_starts_with(basename($entryName), '.')) {
                continue;
            }

            // Cek path traversal
            if (str_contains($entryName, '..')) {
                $zip->close();
                return redirect()->route('admin.backup-storage')
                    ->with('error', 'File ZIP mengandung path tidak valid.');
            }

            $ext = strtolower(pathinfo($entryName, PATHINFO_EXTENSION));
            if (!in_array($ext, $allowedExtensions)) {
                $zip->close();
                return redirect()->route('admin.backup-storage')
                    ->with('error', "File ZIP mengandung tipe file tidak diizinkan: .{$ext}");
            }
        }

        if (!is_dir($targetPath)) {
            mkdir($targetPath, 0755, true);
        }

        $zip->extractTo($targetPath);
        $extractedCount = $zip->numFiles;
        $zip->close();

        // Pastikan symlink public/storage ada
        $this->ensureStorageLink();

        return redirect()->route('admin.backup-storage')
            ->with('success', "Storage berhasil di-restore dari file ZIP ({$extractedCount} item).");
    }

    public function destroy(string $filename)
    {
        $filePath = storage_path("app/{$this->backupPath}/{$filename}");

        if (file_exists($filePath)) {
            unlink($filePath);
            return redirect()->route('admin.backup-storage')
                ->with('success', 'Backup storage berhasil dihapus.');
        }

        return redirect()->route('admin.backup-storage')
            ->with('error', 'File backup tidak ditemukan.');
    }

    /**
     * Buat ulang symlink public/storage -> storage/app/public.
     */
    public function createStorageLink()
    {
        $result = $this->ensureStorageLink();

        if ($result === true) {
            return redirect()->route('admin.backup-storage')
                ->with('success', 'Symlink storage berhasil dibuat.');
        }

        return redirect()->route('admin.backup-storage')
            ->with('error', $result);
    }

    /**
     * Pastikan symlink public/storage -> storage/app/public ada.
     */
    private function ensureStorageLink(): true|string
    {
        $link = public_path('storage');
        $target = storage_path('app/public');

        if (file_exists($link) || is_link($link)) {
            return true;
        }

        if (!is_dir($target)) {
            mkdir($target, 0755, true);
        }

        try {
            symlink($target, $link);
            return true;
        } catch (\Throwable $e) {
            return 'Gagal membuat symlink: ' . $e->getMessage();
        }
    }

    /**
     * Get list of backup ZIP files sorted by newest first.
     */
    private function getBackupFiles(): array
    {
        $path = storage_path("app/{$this->backupPath}");

        if (!is_dir($path)) {
            return [];
        }

        $files = glob($path . '/*.zip');
        $backups = [];

        foreach ($files as $file) {
            $backups[] = [
                'filename' => basename($file),
                'size' => filesize($file),
                'formatted_size' => $this->formatBytes(filesize($file)),
                'date' => date('d M Y H:i', filemtime($file)),
                'timestamp' => filemtime($file),
            ];
        }

        usort($backups, fn($a, $b) => $b['timestamp'] <=> $a['timestamp']);

        return $backups;
    }

    private function formatBytes(int $bytes): string
    {
        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 1) . ' GB';
        }
        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 1) . ' MB';
        }
        return number_format($bytes / 1024, 1) . ' KB';
    }
}
