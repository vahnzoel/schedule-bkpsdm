FROM php:8.3-cli

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libicu-dev \
    sqlite3 \
    libsqlite3-dev \
    && docker-php-ext-install \
    intl \
    pdo \
    pdo_mysql \
    pdo_sqlite \
    zip \
    gd \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER=1

WORKDIR /var/www/html

# WAJIB ada composer.lock
COPY composer.json composer.lock ./

RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --no-progress

COPY . .

EXPOSE 8000
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
