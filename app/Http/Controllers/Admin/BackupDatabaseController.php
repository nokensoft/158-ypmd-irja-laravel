<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BackupDatabaseController extends Controller
{
    private string $backupPath = 'backups';

    public function index()
    {
        $backups = $this->getBackupFiles();
        return view('admin.backup-database', compact('backups'));
    }

    public function create()
    {
        $dbHost = config('database.connections.mysql.host');
        $dbPort = config('database.connections.mysql.port');
        $dbName = config('database.connections.mysql.database');
        $dbUser = config('database.connections.mysql.username');
        $dbPass = config('database.connections.mysql.password');

        $filename = 'backup_' . date('Y-m-d_His') . '.sql';
        $storagePath = storage_path("app/{$this->backupPath}");

        if (!is_dir($storagePath)) {
            mkdir($storagePath, 0755, true);
        }

        $filePath = $storagePath . DIRECTORY_SEPARATOR . $filename;

        // Build mysqldump command
        $command = sprintf(
            'mysqldump --host=%s --port=%s --user=%s --password=%s --single-transaction --routines --triggers --add-drop-table %s',
            escapeshellarg($dbHost),
            escapeshellarg($dbPort),
            escapeshellarg($dbUser),
            escapeshellarg($dbPass),
            escapeshellarg($dbName)
        );

        $output = [];
        $resultCode = 0;

        exec($command . ' 2>&1', $output, $resultCode);

        if ($resultCode !== 0) {
            // Fallback: pure PHP dump
            $sqlContent = $this->dumpWithPHP($dbName);

            if ($sqlContent === false) {
                return redirect()->route('admin.backup-database')
                    ->with('error', 'Gagal membuat backup. Pastikan mysqldump tersedia atau koneksi database benar.');
            }

            file_put_contents($filePath, $sqlContent);
        } else {
            file_put_contents($filePath, implode("\n", $output));
        }

        return redirect()->route('admin.backup-database')
            ->with('success', "Backup berhasil dibuat: {$filename}");
    }

    public function download(string $filename)
    {
        $filePath = storage_path("app/{$this->backupPath}/{$filename}");

        if (!file_exists($filePath)) {
            return redirect()->route('admin.backup-database')->with('error', 'File backup tidak ditemukan.');
        }

        return response()->download($filePath, $filename, [
            'Content-Type' => 'application/sql',
        ]);
    }

    public function destroy(string $filename)
    {
        $filePath = storage_path("app/{$this->backupPath}/{$filename}");

        if (file_exists($filePath)) {
            unlink($filePath);
            return redirect()->route('admin.backup-database')->with('success', 'Backup berhasil dihapus.');
        }

        return redirect()->route('admin.backup-database')->with('error', 'File backup tidak ditemukan.');
    }

    public function restore(Request $request)
    {
        $request->validate([
            'sql_file' => 'required|file|mimes:sql,txt|max:51200',
        ]);

        $file = $request->file('sql_file');
        $sql = file_get_contents($file->getRealPath());

        if (empty(trim($sql))) {
            return redirect()->route('admin.backup-database')->with('error', 'File SQL kosong.');
        }

        try {
            \Illuminate\Support\Facades\DB::unprepared($sql);
            return redirect()->route('admin.backup-database')->with('success', 'Database berhasil di-restore dari file SQL.');
        } catch (\Exception $e) {
            return redirect()->route('admin.backup-database')->with('error', 'Gagal restore: ' . $e->getMessage());
        }
    }

    /**
     * Get list of backup files sorted by newest first.
     */
    private function getBackupFiles(): array
    {
        $path = storage_path("app/{$this->backupPath}");

        if (!is_dir($path)) {
            return [];
        }

        $files = glob($path . '/*.sql');
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

        // Sort newest first
        usort($backups, fn ($a, $b) => $b['timestamp'] <=> $a['timestamp']);

        return $backups;
    }

    /**
     * Fallback: dump database using pure PHP/PDO.
     */
    private function dumpWithPHP(string $dbName): string|false
    {
        try {
            $pdo = \Illuminate\Support\Facades\DB::connection()->getPdo();
            $output = "-- Database Backup\n";
            $output .= "-- Generated: " . date('Y-m-d H:i:s') . "\n";
            $output .= "-- Database: {$dbName}\n";
            $output .= "SET FOREIGN_KEY_CHECKS=0;\n\n";

            $tables = $pdo->query('SHOW TABLES')->fetchAll(\PDO::FETCH_COLUMN);

            foreach ($tables as $table) {
                // Structure
                $output .= "-- Table: {$table}\n";
                $output .= "DROP TABLE IF EXISTS `{$table}`;\n";
                $createTable = $pdo->query("SHOW CREATE TABLE `{$table}`")->fetch(\PDO::FETCH_ASSOC);
                $output .= $createTable['Create Table'] . ";\n\n";

                // Data
                $rows = $pdo->query("SELECT * FROM `{$table}`")->fetchAll(\PDO::FETCH_ASSOC);
                if (count($rows) > 0) {
                    $columns = array_keys($rows[0]);
                    $columnList = '`' . implode('`, `', $columns) . '`';

                    foreach ($rows as $row) {
                        $values = array_map(function ($val) use ($pdo) {
                            if ($val === null) return 'NULL';
                            return $pdo->quote($val);
                        }, array_values($row));

                        $output .= "INSERT INTO `{$table}` ({$columnList}) VALUES (" . implode(', ', $values) . ");\n";
                    }
                    $output .= "\n";
                }
            }

            $output .= "SET FOREIGN_KEY_CHECKS=1;\n";
            return $output;

        } catch (\Exception $e) {
            return false;
        }
    }

    private function formatBytes(int $bytes): string
    {
        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 1) . ' MB';
        }
        return number_format($bytes / 1024, 1) . ' KB';
    }
}
