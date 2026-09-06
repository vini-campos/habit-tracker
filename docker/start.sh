#!/bin/sh

echo "==> Limpando caches do build..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
php artisan event:clear

echo "==> Rodando migrations..."
php artisan migrate --force

echo "==> Cacheando com env vars do Render..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "==> Iniciando PHP-FPM..."
php-fpm -D

echo "==> Iniciando Nginx..."
exec nginx -g "daemon off;"
