FROM php:8.3-fpm

# =========================
# System Dependencies
# =========================
RUN apt update && apt install -y \
    git \
    unzip \
    curl \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libsqlite3-dev \
    sqlite3 \
    libreoffice \
    libreoffice-writer \
    poppler-utils \
    fonts-dejavu \
    fonts-liberation \
    ttf-mscorefonts-installer \
    && apt clean \
    && rm -rf /var/lib/apt/lists/*

# =========================
# PHP Extensions
# =========================
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
    pdo_mysql \
    pdo_sqlite \
    sqlite3 \
    mbstring \
    zip \
    exif \
    pcntl \
    gd \
    opcache

# =========================
# Composer
# =========================
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# =========================
# Working Directory
# =========================
WORKDIR /var/www/html

# =========================
# Copy Application
# =========================
COPY . .

# =========================
# Permissions
# =========================
RUN chown -R www-data:www-data \
    storage \
    bootstrap/cache

# =========================
# Install Dependencies
# =========================
RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction

# =========================
# Optimize Laravel
# =========================
RUN php artisan key:generate || true \
    && php artisan storage:link || true \
    && php artisan config:clear \
    && php artisan route:clear \
    && php artisan view:clear

# =========================
# Expose Port
# =========================
EXPOSE 9000

CMD ["php-fpm"]
