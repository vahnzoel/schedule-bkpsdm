# === Tahap 1: Build Frontend Assets (Vite) ===
FROM node:20-alpine AS frontend-builder
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# === Tahap 2: Aplikasi Utama ===
FROM php:8.3-fpm-alpine

WORKDIR /var/www/html

# Install System Dependencies & Nginx
RUN apk add --no-cache \
    nginx \
    supervisor \
    curl \
    libpng-dev \
    libzip-dev \
    icu-dev \
    sqlite-dev \
    libxml2-dev

# Install PHP Extensions (Optimal & Lengkap)
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions pdo_sqlite gd zip intl bcmath exif opcache pcntl redis

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy Konfigurasi Nginx
RUN printf 'server {\n\
    listen 80;\n\
    index index.php index.html;\n\
    root /var/www/html/public;\n\
    charset utf-8;\n\
    location / {\n\
    try_files $uri $uri/ /index.php?$query_string;\n\
    }\n\
    location ~ \.php$ {\n\
    fastcgi_split_path_info ^(.+\.php)(/.+core);\n\
    fastcgi_pass 127.0.0.1:9000;\n\
    fastcgi_index index.php;\n\
    include fastcgi_params;\n\
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;\n\
    }\n\
    location ~ /\.(?!well-known).* {\n\
    deny all;\n\
    }\n\
    }' > /etc/nginx/http.d/default.conf

# Copy Source Code
COPY . .
# Ambil hasil build Vite dari tahap 1
COPY --from=frontend-builder /app/public/build ./public/build

# Install PHP Dependencies
RUN composer install --no-dev --optimize-autoloader

# Setup SQLite & Permissions
RUN mkdir -p database storage bootstrap/cache && \
    touch database/database.sqlite && \
    chown -R www-data:www-data /var/www/html && \
    chmod -R 775 storage bootstrap/cache database

# Copy Supervisor Config
COPY .docker/supervisord.conf /etc/supervisord.conf

# Env default (Bisa ditimpa di Coolify dashboard)
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV DB_CONNECTION=sqlite
ENV DB_DATABASE=/var/www/html/database/database.sqlite

EXPOSE 80

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]