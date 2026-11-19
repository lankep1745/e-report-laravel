FROM php:8.4-cli

RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libonig-dev libxml2-dev curl \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

RUN rm -f public/hot \
    && composer install --no-dev --optimize-autoloader \
    && npm install \
    && npm run build \
    && chmod -R 775 storage bootstrap/cache

CMD sh -c "php artisan config:clear ; php artisan view:clear ; php artisan migrate --force ; php artisan storage:link ; php -S 0.0.0.0:${PORT:-8080} -t public"