FROM composer:2 AS composer_build
WORKDIR /app

COPY backend/composer.json backend/composer.lock* ./
RUN composer install --ignore-platform-reqs --no-dev --no-scripts --prefer-dist --no-interaction

COPY backend/ ./
RUN composer dump-autoload --optimize

FROM php:8.3-cli
RUN docker-php-ext-install pdo_mysql

WORKDIR /app
COPY --from=composer_build /app /app

RUN ls -la /app && chmod +x /app/artisan || true

EXPOSE 9000
CMD ["php", "/app/artisan", "serve", "--host=0.0.0.0", "--port=9000"]
