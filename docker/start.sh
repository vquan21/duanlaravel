#!/bin/bash

# Generate application key if not set
php artisan key:generate --no-interaction --force

# Wait for database connection...
echo "Waiting for database connection..."
while ! php artisan db:monitor > /dev/null 2>&1; do
    sleep 1
done

# Run migrations
php artisan migrate --force

# Start PHP-FPM
php-fpm &

# Start Nginx
nginx -g "daemon off;"
