#!/bin/sh
set -e

echo "==> Criando .env a partir das variáveis de ambiente..."
cat > /var/www/html/.env << EOF
APP_NAME="${APP_NAME:-Habit Tracker}"
APP_ENV="${APP_ENV:-production}"
APP_KEY="${APP_KEY:-}"
APP_DEBUG="${APP_DEBUG:-false}"
APP_URL="${APP_URL:-http://localhost}"
APP_LOCALE="${APP_LOCALE:-en}"
APP_FALLBACK_LOCALE="${APP_FALLBACK_LOCALE:-en}"

LOG_CHANNEL="${LOG_CHANNEL:-stderr}"
LOG_LEVEL="${LOG_LEVEL:-error}"

DB_CONNECTION="${DB_CONNECTION:-pgsql}"
DB_HOST="${DB_HOST}"
DB_PORT="${DB_PORT:-5432}"
DB_DATABASE="${DB_DATABASE}"
DB_USERNAME="${DB_USERNAME}"
DB_PASSWORD="${DB_PASSWORD}"

SESSION_DRIVER="${SESSION_DRIVER:-database}"
SESSION_LIFETIME="${SESSION_LIFETIME:-120}"
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION="${QUEUE_CONNECTION:-database}"
CACHE_STORE="${CACHE_STORE:-database}"

MAIL_MAILER=log
MAIL_FROM_ADDRESS="${MAIL_FROM_ADDRESS:-hello@example.com}"
MAIL_FROM_NAME="${APP_NAME:-Habit Tracker}"
EOF

echo "==> Gerando APP_KEY..."
php artisan key:generate --force

echo "==> Rodando migrations..."
php artisan migrate --force

echo "==> Otimizando para produção..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

echo "==> Iniciando PHP-FPM..."
php-fpm -D

echo "==> Iniciando Nginx..."
exec nginx -g "daemon off;"
