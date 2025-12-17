FROM php:8.2

# Instalar dependencias
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    && docker-php-ext-install pdo pdo_mysql

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

# Laravel deps
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Permisos
RUN chown -R www-data:www-data storage bootstrap/cache

# Render usa $PORT
EXPOSE 10000

# 🔥 COMANDO CORRECTO PARA RENDER 🔥
CMD php artisan serve --host=0.0.0.0 --port=${PORT}
