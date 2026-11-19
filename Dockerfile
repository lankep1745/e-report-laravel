FROM php:8.4-cli

# Install sistem dependencies, ekstensi PHP untuk Laravel & MySQL, serta Node.js
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev nodejs npm \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

# Install dependency Laravel & Build asset Tailwind/Vite
RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

# Jalankan migrasi, storage link, dan server saat container menyala
CMD sh -c "php artisan migrate --force ; php artisan storage:link ; php artisan config:clear && php artisan view:clear && php artisan serve --host=0.0.0.0 --port=${PORT:-8080}"