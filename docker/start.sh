#!/bin/sh

echo "==> Criando .env a partir das env vars do sistema..."
printenv | grep -E "^(APP_|DB_|SESSION_|CACHE_|QUEUE_|LOG_|MAIL_|BROADCAST_|FILESYSTEM_|BCRYPT_|VITE_)" > /var/www/html/.env

echo "==> Limpando caches..."
php artisan config:clear
php artisan view:clear
php artisan route:clear

echo "==> Gerando APP_KEY..."
php artisan key:generate --force

echo "==> Rodando migrations..."
php artisan migrate --force

echo "==> Iniciando PHP-FPM..."
php-fpm -D

echo "==> Iniciando Nginx..."
exec nginx -g "daemon off;"
