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
php artisan storage:link || true

# Execute the container CMD
exec "$@"
