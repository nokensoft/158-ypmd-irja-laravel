<?php

/**
 * =============================================================
 * GitHub Webhook Auto Deploy
 * URL: https://ypmd-irja.org/deploy.php
 * =============================================================
 *
 * Alur:
 * 1. Validasi signature webhook GitHub
 * 2. Cek apakah push ke branch main
 * 3. Aktifkan maintenance mode
 * 4. Backup database SQL
 * 5. Git pull, composer install, migrate, cache
 * 6. Nonaktifkan maintenance mode
 */

// ─── Konfigurasi ────────────────────────────────────────────

$basePath   = dirname(__DIR__);           // root project Laravel
$envFile    = $basePath . '/.env';
$logFile    = $basePath . '/storage/logs/deploy.log';
$backupDir  = $basePath . '/storage/app/backups';

// ─── Helper Functions ────────────────────────────────────────

/**
 * Parse .env file dan ambil value berdasarkan key.
 */
function getEnvValue(string $envFile, string $key): ?string
{
    if (! file_exists($envFile)) {
        return null;
    }

    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        $line = trim($line);
        if (str_starts_with($line, '#') || ! str_contains($line, '=')) {
            continue;
        }
        [$envKey, $envValue] = explode('=', $line, 2);
        if (trim($envKey) === $key) {
            return trim($envValue, '"\'');
        }
    }

    return null;
}

/**
 * Tulis log ke file.
 */
function deployLog(string $logFile, string $message): void
{
    $timestamp = date('Y-m-d H:i:s');
    file_put_contents($logFile, "[{$timestamp}] {$message}" . PHP_EOL, FILE_APPEND | LOCK_EX);
}

/**
 * Jalankan command dan catat output ke log.
 */
function runCommand(string $command, string $logFile): array
{
    $output = [];
    $exitCode = 0;

    exec($command . ' 2>&1', $output, $exitCode);

    $outputStr = implode("\n", $output);
    deployLog($logFile, "CMD: {$command}");
    deployLog($logFile, "OUT: {$outputStr}");
    deployLog($logFile, "EXIT: {$exitCode}");

    return ['output' => $outputStr, 'exit_code' => $exitCode];
}

// ─── Respond JSON ────────────────────────────────────────────

function respond(int $code, string $message): never
{
    http_response_code($code);
    header('Content-Type: application/json');
    echo json_encode(['message' => $message]);
    exit;
}

// ─── 1. Validasi Request ─────────────────────────────────────

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond(405, 'Method not allowed.');
}

$secret = getEnvValue($envFile, 'DEPLOY_SECRET');

if (empty($secret)) {
    deployLog($logFile, 'ERROR: DEPLOY_SECRET tidak dikonfigurasi di .env');
    respond(500, 'Server misconfigured.');
}

$payload   = file_get_contents('php://input');
$signature = $_SERVER['HTTP_X_HUB_SIGNATURE_256'] ?? '';

if (empty($signature)) {
    deployLog($logFile, 'WARNING: Request tanpa X-Hub-Signature-256 header.');
    respond(403, 'Unauthorized.');
}

$expected = 'sha256=' . hash_hmac('sha256', $payload, $secret);

if (! hash_equals($expected, $signature)) {
    deployLog($logFile, 'WARNING: Signature tidak valid.');
    respond(403, 'Invalid signature.');
}

// ─── 2. Cek Event & Branch ──────────────────────────────────

$event = $_SERVER['HTTP_X_GITHUB_EVENT'] ?? '';

if ($event !== 'push') {
    respond(200, "Ignored event: {$event}.");
}

$data   = json_decode($payload, true);
$branch = $data['ref'] ?? '';

if ($branch !== 'refs/heads/main') {
    respond(200, "Ignored branch: {$branch}.");
}

$pusher = $data['pusher']['name'] ?? 'unknown';
$commit = $data['after'] ?? 'unknown';

deployLog($logFile, '=========================================');
deployLog($logFile, "DEPLOY DIMULAI — pusher: {$pusher}, commit: {$commit}");
deployLog($logFile, '=========================================');

// ─── 3. Maintenance Mode ON ─────────────────────────────────

deployLog($logFile, '[1/8] Mengaktifkan maintenance mode...');
runCommand("cd {$basePath} && php artisan down --secret=\"bypass-deploy-2026\"", $logFile);

// ─── 4. Backup Database ─────────────────────────────────────

deployLog($logFile, '[2/8] Membackup database...');

if (! is_dir($backupDir)) {
    mkdir($backupDir, 0755, true);
}

$dbConnection = getEnvValue($envFile, 'DB_CONNECTION') ?: 'mysql';
$backupFile   = $backupDir . '/db_backup_' . date('Y-m-d_His') . '.sql';

if ($dbConnection === 'mysql') {
    $dbHost     = getEnvValue($envFile, 'DB_HOST') ?: '127.0.0.1';
    $dbPort     = getEnvValue($envFile, 'DB_PORT') ?: '3306';
    $dbName     = getEnvValue($envFile, 'DB_DATABASE') ?: 'laravel';
    $dbUser     = getEnvValue($envFile, 'DB_USERNAME') ?: 'root';
    $dbPassword = getEnvValue($envFile, 'DB_PASSWORD') ?: '';

    $dumpCmd = sprintf(
        'mysqldump --host=%s --port=%s --user=%s --password=%s %s > %s',
        escapeshellarg($dbHost),
        escapeshellarg($dbPort),
        escapeshellarg($dbUser),
        escapeshellarg($dbPassword),
        escapeshellarg($dbName),
        escapeshellarg($backupFile)
    );

    $result = runCommand($dumpCmd, $logFile);

    if ($result['exit_code'] === 0 && file_exists($backupFile) && filesize($backupFile) > 0) {
        $size = round(filesize($backupFile) / 1024, 2);
        deployLog($logFile, "Backup berhasil: {$backupFile} ({$size} KB)");
    } else {
        deployLog($logFile, 'WARNING: Backup gagal, melanjutkan deploy...');
    }

    // Hapus backup lama (simpan 5 terakhir)
    $backups = glob($backupDir . '/db_backup_*.sql');
    if (count($backups) > 5) {
        usort($backups, fn($a, $b) => filemtime($a) - filemtime($b));
        $toDelete = array_slice($backups, 0, count($backups) - 5);
        foreach ($toDelete as $old) {
            unlink($old);
            deployLog($logFile, "Backup lama dihapus: " . basename($old));
        }
    }

} elseif ($dbConnection === 'sqlite') {
    $dbPath    = getEnvValue($envFile, 'DB_DATABASE') ?: $basePath . '/database/database.sqlite';
    $sqliteBackup = str_replace('.sql', '.sqlite', $backupFile);

    if (file_exists($dbPath)) {
        copy($dbPath, $sqliteBackup);
        $size = round(filesize($sqliteBackup) / 1024, 2);
        deployLog($logFile, "Backup SQLite berhasil: {$sqliteBackup} ({$size} KB)");
    } else {
        deployLog($logFile, 'WARNING: File SQLite tidak ditemukan.');
    }
} else {
    deployLog($logFile, "WARNING: Backup tidak didukung untuk koneksi: {$dbConnection}");
}

// ─── 5. Git Pull ─────────────────────────────────────────────

deployLog($logFile, '[3/8] Git pull origin main...');
$result = runCommand("cd {$basePath} && git pull origin main", $logFile);

if ($result['exit_code'] !== 0) {
    deployLog($logFile, 'ERROR: Git pull gagal! Menonaktifkan maintenance mode...');
    runCommand("cd {$basePath} && php artisan up", $logFile);
    respond(500, 'Git pull failed.');
}

// ─── 6. Composer Install ─────────────────────────────────────

deployLog($logFile, '[4/8] Composer install...');
runCommand("cd {$basePath} && composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader", $logFile);

// ─── 7. Migrate ──────────────────────────────────────────────

deployLog($logFile, '[5/8] Running migrations...');
runCommand("cd {$basePath} && php artisan migrate --force", $logFile);

// ─── 8. Cache ────────────────────────────────────────────────

deployLog($logFile, '[6/8] Rebuilding caches...');
runCommand("cd {$basePath} && php artisan config:cache", $logFile);
runCommand("cd {$basePath} && php artisan route:cache", $logFile);
runCommand("cd {$basePath} && php artisan view:cache", $logFile);
runCommand("cd {$basePath} && php artisan event:cache", $logFile);

// ─── 9. Permissions ──────────────────────────────────────────

deployLog($logFile, '[7/8] Setting permissions...');
runCommand("chmod -R 775 {$basePath}/storage {$basePath}/bootstrap/cache", $logFile);

// ─── 10. Maintenance Mode OFF ────────────────────────────────

deployLog($logFile, '[8/8] Menonaktifkan maintenance mode...');
runCommand("cd {$basePath} && php artisan up", $logFile);

deployLog($logFile, 'DEPLOY SELESAI.');
deployLog($logFile, '=========================================');
deployLog($logFile, '');

respond(200, 'Deployment completed successfully.');
