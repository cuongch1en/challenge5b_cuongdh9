#!/bin/bash
set -e

git config --global --add safe.directory /var/www/html

if [ ! -d "/var/www/html/vendor" ]; then
  echo "Installing dependencies..."
  composer install --no-interaction
fi

if [ ! -f "/var/www/html/public/build/manifest.json" ]; then
  echo "Building frontend assets..."
  npm install && npm run build
fi

echo "Checking MySQL connection..."
max_attempts=30
counter=0
while ! mysqladmin ping -h mysql -u root --silent && [ $counter -lt $max_attempts ]; do
    echo "MySQL connection attempt $counter failed, waiting..."
    counter=$((counter+1))
    sleep 2
done

if [ $counter -eq $max_attempts ]; then
    echo "ERROR: Could not connect to MySQL after $max_attempts attempts!"
    echo "Network diagnostic information:"
    echo "--- Container IP ---"
    hostname -I
    echo "--- Ping MySQL host ---"
    ping -c 1 mysql || echo "Ping failed"
    echo "--- MySQL host lookup ---"
    getent hosts mysql || echo "Host lookup failed"
    echo "--- Network interfaces ---"
    ip addr show
    exit 1
else
    echo "Successfully connected to MySQL!"
fi

mkdir -p storage/framework/{sessions,views,cache} bootstrap/cache
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

php artisan migrate || echo "Migrations failed but continuing..."
php artisan db:seed --class=AdminUserSeeder
php artisan serve --host=0.0.0.0 --port=8000