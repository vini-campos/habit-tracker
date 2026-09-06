#!/bin/sh
set -e

echo "==> Gerando APP_KEY (se não existir)..."
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