#!/bin/sh

echo "==> Criando .env a partir das variáveis de ambiente..."
printenv | grep -E "^(APP_|DB_|SESSION_|CACHE_|QUEUE_|LOG_|MAIL_|BROADCAST_|FILESYSTEM_|BCRYPT_|VITE_)" > /var/www/html/.env

echo "==> Conteúdo do .env gerado:"
cat /var/www/html/.env

echo "==> Gerando APP_KEY..."
php artisan key:generate --force
echo "key:generate status: $?"

echo "==> Rodando migrations..."
php artisan migrate --force
echo "migrate status: $?"

echo "==> Otimizando..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "==> Iniciando PHP-FPM..."
php-fpm -D

echo "==> Iniciando Nginx..."
exec nginx -g "daemon off;"
