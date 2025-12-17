# ---------- FRONTEND (VITE) ----------
FROM node:18 AS nodebuild
WORKDIR /app

COPY package*.json ./
RUN npm install

COPY resources ./resources
COPY vite.config.js ./
RUN npm run build


# ---------- BACKEND (LARAVEL) ----------
FROM php:8.2

RUN apt-get update && apt-get install -y \
    git unzip curl libpng-dev libonig-dev libxml2-dev zip \
    && docker-php-ext-install pdo pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

# 🔥 Copiamos el build de Vite al public
COPY --from=nodebuild /app/public/build public/build

RUN composer install --no-interaction --prefer-dist --optimize-autoloader
RUN chown -R www-data:www-data storage bootstrap/cache public/build
RUN php artisan optimize:clear

EXPOSE 10000
CMD php artisan serve --host=0.0.0.0 --port=$PORT
