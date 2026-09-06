FROM php:8.4-fpm-alpine

# Dependências do sistema
RUN apk add --no-cache \
    nginx \
    nodejs \
    npm \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libzip-dev \
    oniguruma-dev \
    postgresql-dev

# Extensões PHP
RUN docker-php-ext-install \
    pdo_pgsql \
    pdo_mysql \
    mbstring \
    zip \
    gd \
    bcmath

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copia o projeto
COPY . .

# Dependências PHP (sem dev)
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Dependências JS e build dos assets
RUN npm ci && npm run build

# Remove caches gerados durante o build
RUN php artisan config:clear || true \
    && php artisan view:clear || true \
    && php artisan route:clear || true

# Permissões
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 777 storage bootstrap/cache

# Remove .env local para forçar leitura das env vars do Render
RUN rm -f /var/www/html/.env

# Configuração do Nginx
COPY docker/nginx.conf /etc/nginx/nginx.conf

# Script de inicialização
COPY docker/start.sh /start.sh
RUN chmod +x /start.sh

EXPOSE 8080

CMD ["/start.sh"]
