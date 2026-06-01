FROM node:20 AS node-build

WORKDIR /app

COPY package.json package-lock.json* ./
COPY postcss.config.js tailwind.config.js ./
COPY resources resources

RUN npm install
RUN npm run build
RUN npm run build:vite


FROM php:8.3-cli

RUN apt-get update && apt-get install -y \
    unzip \
    git \
    libsqlite3-dev \
    sqlite3 \
    curl \
    gnupg \
    && docker-php-ext-install pdo pdo_sqlite bcmath

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN cp .env.example .env
COPY .env.example .env
RUN php artisan key:generate
# Copy built frontend assets from node build stage
COPY --from=node-build /app/public ./public


# Migrations should run at container runtime, not during image build.
# Removing `php artisan migrate --force` from the build to avoid
# database-specific SQL errors (SQLite vs MySQL).
COPY entrypoint.sh ./entrypoint.sh
RUN chmod +x ./entrypoint.sh

EXPOSE 10000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=10000"]
ENTRYPOINT ["./entrypoint.sh"]