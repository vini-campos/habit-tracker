#!/bin/sh

echo "==> Limpando caches..."
php artisan config:clear
php artisan view:clear
php artisan route:clear

echo "==> Rodando migrations..."
php artisan migrate --force

echo "==> Iniciando PHP-FPM..."
php-fpm -D

echo "==> Iniciando Nginx..."
exec nginx -g "daemon off;"
