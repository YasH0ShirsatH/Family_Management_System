#!/bin/sh
set -e

# Copy .env if it does not exist
if [ ! -f .env ] && [ -f .env.example ]; then
    cp .env.example .env
fi

# Generate key if missing
if ! grep -q '^APP_KEY=.*' .env || grep 'APP_KEY=' .env | grep -q '^[^=]*=$'; then
    php artisan key:generate --force
fi

# Wait for DB if needed
echo "Waiting for DB to be available before running migrations..."
php artisan migrate --force || (
  echo "Migration failed (DB not ready?), sleeping 5s and retrying up to 10 times..." && \
  for i in $(seq 1 10); do
    sleep 5 && php artisan migrate --force && break
  done
)

exec "$@"