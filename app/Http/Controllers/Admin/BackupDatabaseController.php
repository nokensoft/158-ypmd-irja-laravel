<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BackupDatabaseController extends Controller
{
    private string $backupPath = 'backups';

    /**
     * Tabel sistem/framework yang tidak perlu di-backup.
     */
    private array $excludedTables = [
        'cache',
        'cache_locks',
        'failed_jobs',
        'job_batches',
        'jobs',
        'migrations',
        'password_reset_tokens',
        'personal_access_tokens',
        'sessions',
    ];

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

        $ignoreTables = '';
        foreach ($this->excludedTables as $table) {
            $ignoreTables .= ' --ignore-table=' . escapeshellarg("{$dbName}.{$table}");
        }

        // Build mysqldump command
        $command = sprintf(
            'mysqldump --host=%s --port=%s --user=%s --password=%s --default-character-set=utf8mb4 --single-transaction --quick --routines --triggers --events --add-drop-table --skip-lock-tables %s%s > %s',
            escapeshellarg($dbHost),
            escapeshellarg($dbPort),
            escapeshellarg($dbUser),
            escapeshellarg($dbPass),
            escapeshellarg($dbName),
            $ignoreTables,
            escapeshellarg($filePath)
        );

        $resultCode = 1;

        if (function_exists('exec')) {
            $output = [];
            $resultCode = 0;
            \exec($command . ' 2>&1', $output, $resultCode);
        }

        if ($resultCode !== 0 || !file_exists($filePath) || filesize($filePath) === 0) {
            // Fallback: pure PHP dump
            $sqlContent = $this->dumpWithPHP($dbName);

            if ($sqlContent === false) {
                return redirect()->route('admin.backup-database')
                    ->with('error', 'Gagal membuat backup. Pastikan mysqldump tersedia atau koneksi database benar.');
            }

            file_put_contents($filePath, $sqlContent);
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
        $filePath = $file->getRealPath();

        if (empty($filePath) || !is_readable($filePath)) {
            return redirect()->route('admin.backup-database')->with('error', 'File SQL tidak dapat dibaca.');
        }

        // Coba restore via mysql CLI terlebih dahulu
        $cliRestore = $this->restoreWithMysqlClient($filePath);

        try {
            if (!$cliRestore['success']) {
                // Fallback: restore via PHP/PDO
                $sql = file_get_contents($filePath);
                $sql = preg_replace('/^\xEF\xBB\xBF/', '', $sql ?? '');

                if (empty(trim($sql ?? ''))) {
                    return redirect()->route('admin.backup-database')->with('error', 'File SQL kosong.');
                }

                $this->executeSqlStatements($sql);
            }

            return redirect()->route('admin.backup-database')->with('success', 'Database berhasil di-restore dari file SQL.');
        } catch (\Throwable $e) {
            $errorMessage = trim(($cliRestore['error'] ?? '') . ' ' . $e->getMessage());
            $errorMessage = preg_replace('/\s+/', ' ', $errorMessage ?? '');
            $errorMessage = substr($errorMessage, 0, 300);

            return redirect()->route('admin.backup-database')->with('error', 'Gagal restore: ' . $errorMessage);
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
            $pdo = DB::connection()->getPdo();
            $output = "-- =============================================\n";
            $output .= "-- Database Backup (PHP Fallback)\n";
            $output .= "-- Generated: " . date('Y-m-d H:i:s') . "\n";
            $output .= "-- Database: {$dbName}\n";
            $output .= "-- Format: schema + data (application tables)\n";
            $output .= "-- =============================================\n\n";
            $output .= "SET NAMES utf8mb4;\n";
            $output .= "SET FOREIGN_KEY_CHECKS=0;\n\n";

            $tables = $this->getApplicationTables($pdo);

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
                            if ($val === null) {
                                return 'NULL';
                            }

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

    /**
     * Restore SQL via mysql CLI client.
     */
    private function restoreWithMysqlClient(string $sqlFilePath): array
    {
        $dbHost = config('database.connections.mysql.host');
        $dbPort = config('database.connections.mysql.port');
        $dbName = config('database.connections.mysql.database');
        $dbUser = config('database.connections.mysql.username');
        $dbPass = config('database.connections.mysql.password');

        $command = sprintf(
            'mysql --host=%s --port=%s --user=%s --password=%s %s < %s',
            escapeshellarg($dbHost),
            escapeshellarg($dbPort),
            escapeshellarg($dbUser),
            escapeshellarg($dbPass),
            escapeshellarg($dbName),
            escapeshellarg($sqlFilePath)
        );

        if (!function_exists('exec')) {
            return [
                'success' => false,
                'error' => 'exec() is disabled on this server.',
            ];
        }

        $output = [];
        $resultCode = 0;
        \exec($command . ' 2>&1', $output, $resultCode);

        return [
            'success' => $resultCode === 0,
            'error' => trim(implode("\n", $output)),
        ];
    }

    /**
     * Execute SQL statements satu per satu dengan penanganan delimiter.
     */
    private function executeSqlStatements(string $sql): void
    {
        $lines = preg_split('/\r\n|\r|\n/', $sql);
        $delimiter = ';';
        $statement = '';

        DB::unprepared('SET FOREIGN_KEY_CHECKS=0');

        try {
            foreach ($lines as $line) {
                $trimmed = trim($line);

                // Skip komentar dan baris kosong
                if ($trimmed === '' || str_starts_with($trimmed, '--') || str_starts_with($trimmed, '#')) {
                    continue;
                }

                // Handle DELIMITER statement
                if (str_starts_with(strtoupper($trimmed), 'DELIMITER ')) {
                    $newDelimiter = trim(substr($trimmed, 10));
                    $delimiter = $newDelimiter !== '' ? $newDelimiter : ';';
                    continue;
                }

                $statement .= $line . "\n";

                if (!$this->statementEndsWithDelimiter($statement, $delimiter)) {
                    continue;
                }

                $query = trim($this->removeTrailingDelimiter($statement, $delimiter));
                if ($query !== '') {
                    DB::unprepared($query);
                }

                $statement = '';
            }

            // Eksekusi sisa statement jika ada
            $remaining = trim($statement);
            if ($remaining !== '') {
                DB::unprepared($remaining);
            }
        } finally {
            DB::unprepared('SET FOREIGN_KEY_CHECKS=1');
        }
    }

    private function statementEndsWithDelimiter(string $statement, string $delimiter): bool
    {
        return str_ends_with(rtrim($statement), $delimiter);
    }

    private function removeTrailingDelimiter(string $statement, string $delimiter): string
    {
        $trimmed = rtrim($statement);

        if (!str_ends_with($trimmed, $delimiter)) {
            return $trimmed;
        }

        return substr($trimmed, 0, -strlen($delimiter));
    }

    /**
     * Get only application tables (exclude system/framework tables).
     */
    private function getApplicationTables(\PDO $pdo): array
    {
        $tables = $pdo->query('SHOW TABLES')->fetchAll(\PDO::FETCH_COLUMN);

        return array_values(array_filter($tables, function ($table) {
            return !in_array($table, $this->excludedTables, true);
        }));
    }

    private function formatBytes(int $bytes): string
    {
        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 1) . ' MB';
        }
        return number_format($bytes / 1024, 1) . ' KB';
    }
}
