# ---- Stage 1: Composer & Node Builder ----
FROM composer:2.7 AS build

# Install Node.js (LTS)
RUN apk add --no-cache nodejs npm

WORKDIR /app

# Copy composer manifests and install dependencies without scripts
COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --optimize-autoloader --no-scripts

# Copy package.json and install/build Vite assets if needed
COPY package.json package-lock.json* npm-shrinkwrap.json* ./
RUN if [ -f package.json ]; then npm ci --omit=dev && npm run build; fi

# Copy the rest of the app
COPY . .

# Run composer scripts after copying all files
RUN composer run-script post-autoload-dump

# ---- Stage 2: Nginx + PHP-FPM + Supervisor ----
FROM php:8.2-fpm-alpine AS app

LABEL maintainer="YourName <your@email.com>"

# Runtime dependencies (Nginx, Supervisor, system & PHP extensions)
RUN apk add --no-cache nginx supervisor bash tzdata curl git icu-data-full \
    icu-dev oniguruma-dev libxml2-dev libzip-dev zlib-dev && \
    docker-php-ext-install bcmath ctype fileinfo intl mbstring pcntl pdo pdo_mysql tokenizer xml zip exif opcache && \
    apk del icu-dev oniguruma-dev libxml2-dev libzip-dev zlib-dev && \
    rm -rf /var/cache/apk/*

# PHP-FPM as www-data
RUN sed -i 's/^user = .*/user = www-data/' /usr/local/etc/php-fpm.d/www.conf

WORKDIR /var/www/html

# Copy built app, vendor, and assets from build stage
COPY --from=build /app ./

# Nginx & Supervisor configs, entrypoint
COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/supervisord.conf /etc/supervisord.conf
COPY docker/docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh

RUN chmod +x /usr/local/bin/docker-entrypoint.sh && \
    chown -R www-data:www-data /var/www/html && \
    chmod -R 775 storage bootstrap/cache

# Healthcheck for Railway
HEALTHCHECK --interval=30s --timeout=5s --start-period=30s --retries=3 \
  CMD curl -f http://localhost:$PORT/ || exit 1

EXPOSE $PORT

ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]
