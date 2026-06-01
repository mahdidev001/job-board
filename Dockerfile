FROM php:8.3-cli

RUN apt-get update && apt-get install -y \
    unzip \
    git \
    libsqlite3-dev \
    sqlite3 \
    && docker-php-ext-install pdo pdo_sqlite bcmath

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN cp .env.example .env
COPY .env.example .env
RUN php artisan key:generate
RUN touch database/database.sqlite


# Migrations should run at container runtime, not during image build.
# Removing `php artisan migrate --force` from the build to avoid
# database-specific SQL errors (SQLite vs MySQL).
COPY entrypoint.sh ./entrypoint.sh
RUN chmod +x ./entrypoint.sh

EXPOSE 10000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=10000"]
ENTRYPOINT ["./entrypoint.sh"]