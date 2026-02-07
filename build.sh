#!/usr/bin/env bash
set -euo pipefail

echo "Starting full stack build..."

# Pastikan direktori database ada
mkdir -p /app/database

# SQLite file
if [ ! -f /app/database/database.sqlite ]; then
    touch /app/database/database.sqlite
fi

# Composer
echo "Installing PHP dependencies..."
composer install --no-interaction --prefer-dist --optimize-autoloader

# NPM / assets
echo "Installing Node dependencies..."
npm install
npm run build

# Permissions
echo "Setting permissions..."
chmod -R 775 storage bootstrap/cache database

# Migrations
echo "Running database migrations..."
php artisan migrate --force

echo "Build complete."
