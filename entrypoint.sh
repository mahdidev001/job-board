#!/bin/sh
set -e

# Generate app key if not set
if [ -z "$APP_KEY" ]; then
  php artisan key:generate --ansi
fi

# Ensure sqlite file exists when using sqlite
if [ "$DB_CONNECTION" = "sqlite" ]; then
  mkdir -p database
  touch database/database.sqlite
fi

# Run migrations and other one-time runtime tasks
php artisan migrate --force || true

# Create the storage symlink only if it does not already exist
if [ ! -e public/storage ]; then
  php artisan storage:link
fi

# Execute the container CMD
exec "$@"
