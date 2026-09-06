#!/bin/sh
set -e

echo "==> Criando .env a partir das variáveis de ambiente..."
printenv | grep -E "^(APP_|DB_|SESSION_|CACHE_|QUEUE_|LOG_|MAIL_|BROADCAST_|FILESYSTEM_|BCRYPT_|VITE_)" > /var/www/html/.env

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
