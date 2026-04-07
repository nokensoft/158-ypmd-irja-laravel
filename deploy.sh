#!/bin/bash

# =============================================================
# Auto Deploy Script - Triggered by GitHub Webhook
# =============================================================

set -e

APP_DIR="$(cd "$(dirname "$0")" && pwd)"
LOG_FILE="$APP_DIR/storage/logs/deploy.log"
BACKUP_DIR="$APP_DIR/storage/app/backups"
ENV_FILE="$APP_DIR/.env"

# Helper: ambil value dari .env
get_env() {
    grep "^$1=" "$ENV_FILE" | cut -d '=' -f2- | tr -d '"' | tr -d "'"
}

echo "=======================================" >> "$LOG_FILE"
echo "Deploy started at $(date '+%Y-%m-%d %H:%M:%S')" >> "$LOG_FILE"
echo "=======================================" >> "$LOG_FILE"

cd "$APP_DIR"

# [1/8] Maintenance mode ON
echo "[1/8] Mengaktifkan maintenance mode..." >> "$LOG_FILE"
php artisan down --secret="bypass-deploy-2026" 2>&1 >> "$LOG_FILE" || true

# [2/8] Backup database
echo "[2/8] Membackup database..." >> "$LOG_FILE"
mkdir -p "$BACKUP_DIR"

DB_CONNECTION=$(get_env DB_CONNECTION)
BACKUP_FILE="$BACKUP_DIR/db_backup_$(date '+%Y-%m-%d_%H%M%S').sql"

if [ "$DB_CONNECTION" = "mysql" ] || [ -z "$DB_CONNECTION" ]; then
    DB_HOST=$(get_env DB_HOST)
    DB_PORT=$(get_env DB_PORT)
    DB_DATABASE=$(get_env DB_DATABASE)
    DB_USERNAME=$(get_env DB_USERNAME)
    DB_PASSWORD=$(get_env DB_PASSWORD)

    mysqldump --host="${DB_HOST:-127.0.0.1}" \
              --port="${DB_PORT:-3306}" \
              --user="${DB_USERNAME:-root}" \
              --password="${DB_PASSWORD}" \
              "${DB_DATABASE:-laravel}" > "$BACKUP_FILE" 2>&1 && \
        echo "Backup berhasil: $BACKUP_FILE ($(du -h "$BACKUP_FILE" | cut -f1))" >> "$LOG_FILE" || \
        echo "WARNING: Backup gagal, melanjutkan deploy..." >> "$LOG_FILE"

    # Hapus backup lama (simpan 5 terakhir)
    ls -1t "$BACKUP_DIR"/db_backup_*.sql 2>/dev/null | tail -n +6 | while read f; do
        rm -f "$f"
        echo "Backup lama dihapus: $(basename "$f")" >> "$LOG_FILE"
    done

elif [ "$DB_CONNECTION" = "sqlite" ]; then
    DB_PATH=$(get_env DB_DATABASE)
    DB_PATH=${DB_PATH:-"$APP_DIR/database/database.sqlite"}
    SQLITE_BACKUP="${BACKUP_FILE%.sql}.sqlite"
    if [ -f "$DB_PATH" ]; then
        cp "$DB_PATH" "$SQLITE_BACKUP"
        echo "Backup SQLite berhasil: $SQLITE_BACKUP" >> "$LOG_FILE"
    fi
fi

# [3/8] Pull latest changes from main
echo "[3/8] Git pull origin main..." >> "$LOG_FILE"
git pull origin main 2>&1 >> "$LOG_FILE"

# [4/8] Install/update composer dependencies
echo "[4/8] Composer install..." >> "$LOG_FILE"
composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader 2>&1 >> "$LOG_FILE"

# [5/8] Run database migrations
echo "[5/8] Running migrations..." >> "$LOG_FILE"
php artisan migrate --force 2>&1 >> "$LOG_FILE"

# [6/8] Clear and rebuild caches
echo "[6/8] Rebuilding caches..." >> "$LOG_FILE"
php artisan config:cache 2>&1 >> "$LOG_FILE"
php artisan route:cache 2>&1 >> "$LOG_FILE"
php artisan view:cache 2>&1 >> "$LOG_FILE"
php artisan event:cache 2>&1 >> "$LOG_FILE"

# [7/8] Set correct permissions
echo "[7/8] Setting permissions..." >> "$LOG_FILE"
chmod -R 775 storage bootstrap/cache 2>&1 >> "$LOG_FILE"

# [8/8] Maintenance mode OFF
echo "[8/8] Menonaktifkan maintenance mode..." >> "$LOG_FILE"
php artisan up 2>&1 >> "$LOG_FILE"

echo "Deploy completed at $(date '+%Y-%m-%d %H:%M:%S')" >> "$LOG_FILE"
echo "" >> "$LOG_FILE"
