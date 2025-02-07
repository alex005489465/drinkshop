#!/bin/sh

cd /var/www/html

# Check if .env file exists
if [ ! -f .env ]; then
    cp .env.example .env
    sed -i "s/DB_CONNECTION=.*/DB_CONNECTION=sqlite/" .env
    php artisan key:generate
fi

# Ensure proper permissions for storage and logs
mkdir -p storage/logs
touch storage/logs/laravel.log
find storage -type d -exec chmod 775 {} \;
find storage -type f -exec chmod 664 {} \;
chown -R www-data:www-data storage bootstrap/cache database
chmod 664 storage/logs/laravel.log

# Create database file and set permissions
touch database/database.sqlite
chown www-data:www-data database/database.sqlite
chmod 664 database/database.sqlite

# Clear caches and run session migration
php artisan config:clear
php artisan cache:clear

php artisan migrate --force

php artisan db:seed --class=ProductSeeder --force

# Start PHP-FPM
php-fpm
