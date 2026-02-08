# --- Stage 1: Build Assets (Vite) ---
FROM node:20-alpine AS assets
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# --- Stage 2: Main Application ---
FROM php:8.3-fpm-alpine

WORKDIR /var/www/html

# Install System Dependencies & Nginx
RUN apk add --no-cache \
    nginx \
    supervisor \
    curl \
    libpng-dev \
    libzip-dev \
    sqlite-dev

# Install PHP Extensions (Termasuk SQLite3)
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions pdo_sqlite gd zip intl bcmath exif opcache pcntl redis

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy Application Code
COPY . .
COPY --from=assets /app/public/build ./public/build

# Install PHP Dependencies
RUN composer install --no-dev --optimize-autoloader

# Configure Nginx
RUN printf 'server {\n\
    listen 80;\n\
    root /var/www/html/public;\n\
    index index.php;\n\
    charset utf-8;\n\
    location / {\n\
    try_files $uri $uri/ /index.php?$query_string;\n\
    }\n\
    location ~ \.php$ {\n\
    fastcgi_pass 127.0.0.1:9000;\n\
    fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;\n\
    include fastcgi_params;\n\
    }\n\
    error_page 404 /index.php;\n\
    }' > /etc/nginx/http.d/default.conf

# Configure Supervisor (Untuk menjalankan Nginx & PHP-FPM bersamaan)
RUN printf '[supervisord]\n\
    nodaemon=true\n\
    user=root\n\
    [program:php-fpm]\n\
    command=php-fpm\n\
    [program:nginx]\n\
    command=nginx -g "daemon off;"' > /etc/supervisord.conf

# Setup SQLite Database
RUN mkdir -p database && \
    touch database/database.sqlite && \
    chown -R www-data:www-data /var/www/html && \
    chmod -R 775 storage bootstrap/cache database

# Environment variables untuk Coolify
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV DB_CONNECTION=sqlite
ENV DB_DATABASE=/var/www/html/database/database.sqlite

EXPOSE 80

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]