FROM php:8.4-fpm-alpine

RUN apk add --no-cache \
    nginx nodejs npm git curl zip unzip \
    libpng-dev libzip-dev oniguruma-dev postgresql-dev

RUN docker-php-ext-install \
    pdo_pgsql pdo_mysql mbstring zip gd bcmath

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader --no-interaction

RUN npm ci && npm run build

RUN php artisan config:clear || true \
    && php artisan view:clear || true \
    && php artisan route:clear || true \
    && rm -f bootstrap/cache/*.php

RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 777 storage bootstrap/cache

RUN rm -f /var/www/html/.env

# Permite que o PHP-FPM herde as env vars do sistema
RUN echo "clear_env = no" >> /usr/local/etc/php-fpm.d/www.conf

COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/start.sh /start.sh
RUN chmod +x /start.sh

EXPOSE 8080

CMD ["/start.sh"]
