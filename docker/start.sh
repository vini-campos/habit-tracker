#!/bin/sh

echo "==> Limpando caches..."
php artisan config:clear 2>/dev/null || true
php artisan cache:clear 2>/dev/null || true

echo "==> Rodando migrations..."
php artisan migrate --force

echo "==> Cacheando..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "==> Iniciando PHP-FPM..."
php-fpm -D

echo "==> Iniciando Nginx..."
exec nginx -g "daemon off;"
