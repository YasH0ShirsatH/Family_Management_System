#!/bin/sh
set -e

# Set default PORT if not provided by Railway
export PORT=${PORT:-80}

# Replace $PORT in nginx config
sed -i "s/\$PORT/$PORT/g" /etc/nginx/nginx.conf

# Copy .env if it does not exist
if [ ! -f .env ] && [ -f .env.example ]; then
    cp .env.example .env
fi

# Generate key if missing
if ! grep -q '^APP_KEY=.*' .env || grep 'APP_KEY=' .env | grep -q '^[^=]*=$'; then
    php artisan key:generate --force
fi

# Cache config for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Wait for DB to be ready (retry)
echo "Waiting for DB to be available before running migrations..."
php artisan migrate --force || (
  echo "Migration failed (DB not ready?), retrying up to 10 times..." && \
  for i in $(seq 1 10); do
    sleep 5 && php artisan migrate --force && break
  done
)

# Seed database if needed
php artisan db:seed --force || echo "Seeding failed or already done"

exec "$@"
