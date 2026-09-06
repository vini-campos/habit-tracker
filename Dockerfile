FROM php:8.3-fpm-alpine

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

# Permissões
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Configuração do Nginx
COPY docker/nginx.conf /etc/nginx/nginx.conf

# Script de inicialização
COPY docker/start.sh /start.sh
RUN chmod +x /start.sh

EXPOSE 8080

CMD ["/start.sh"]