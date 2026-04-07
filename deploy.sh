#!/bin/bash

# =============================================================
# Auto Deploy Script - Triggered by GitHub Webhook
# =============================================================

set -e

APP_DIR="$(cd "$(dirname "$0")" && pwd)"
LOG_FILE="$APP_DIR/storage/logs/deploy.log"

echo "=======================================" >> "$LOG_FILE"
echo "Deploy started at $(date '+%Y-%m-%d %H:%M:%S')" >> "$LOG_FILE"
echo "=======================================" >> "$LOG_FILE"

cd "$APP_DIR"

# Pull latest changes from main
echo "[1/6] Pulling latest changes..." >> "$LOG_FILE"
git pull origin main 2>&1 >> "$LOG_FILE"

# Install/update composer dependencies
echo "[2/6] Installing composer dependencies..." >> "$LOG_FILE"
composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader 2>&1 >> "$LOG_FILE"

# Run database migrations
echo "[3/6] Running migrations..." >> "$LOG_FILE"
php artisan migrate --force 2>&1 >> "$LOG_FILE"

# Clear and rebuild caches
echo "[4/6] Clearing caches..." >> "$LOG_FILE"
php artisan config:cache 2>&1 >> "$LOG_FILE"
php artisan route:cache 2>&1 >> "$LOG_FILE"
php artisan view:cache 2>&1 >> "$LOG_FILE"
php artisan event:cache 2>&1 >> "$LOG_FILE"

# Build frontend assets (uncomment if needed)
# echo "[5/6] Building frontend assets..." >> "$LOG_FILE"
# npm ci 2>&1 >> "$LOG_FILE"
# npm run build 2>&1 >> "$LOG_FILE"

# Set correct permissions
echo "[5/6] Setting permissions..." >> "$LOG_FILE"
chmod -R 775 storage bootstrap/cache 2>&1 >> "$LOG_FILE"

# Restart queue workers if running
echo "[6/6] Restarting queue workers..." >> "$LOG_FILE"
php artisan queue:restart 2>&1 >> "$LOG_FILE"

echo "Deploy completed at $(date '+%Y-%m-%d %H:%M:%S')" >> "$LOG_FILE"
echo "" >> "$LOG_FILE"
