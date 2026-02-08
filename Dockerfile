# Stage 1: PHP Dependencies
FROM php:8.3-fpm-alpine as vendor

WORKDIR /var/www/html

# Install system dependencies
RUN apk add --no-cache \
    bash curl unzip git libicu-dev libzip-dev libpng-dev libjpeg-dev libfreetype6-dev libssl-dev libsqlite3-dev \
    libreoffice --no-install-recommends \
    poppler-utils

# Install PHP extensions
RUN docker-php-ext-install -j$(nproc) pcntl opcache pdo pdo_mysql pdo_sqlite intl zip gd exif ftp bcmath

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy composer files
COPY composer.json composer.lock ./

# Install dependencies
RUN composer install --no-scripts --no-autoloader --prefer-dist

# Stage 2: Node Assets (Untuk Vite & Livewire)
FROM node:20-alpine as frontend

WORKDIR /var/www/html

COPY package.json package-lock.json ./
RUN npm install

COPY . .
RUN npm run build

# Stage 3: Final Production Image
FROM php:8.3-fpm-alpine

WORKDIR /var/www/html

# Install runtime dependencies
RUN apk add --no-cache \
    libicu \
    libzip \
    libpng \
    libjpeg \
    libfreetype6 \
    libssl \
    libsqlite3

RUN docker-php-ext-install -j$(nproc) pcntl opcache pdo pdo_mysql pdo_sqlite intl zip gd exif ftp bcmath

# Copy app from previous stages
COPY --from=vendor /var/www/html/vendor ./vendor
COPY --from=frontend /var/www/html/public/build ./public/build
COPY . .

# Optimization for Laravel
RUN php artisan optimize:clear && \
    chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 9000

CMD ["php-fpm"]