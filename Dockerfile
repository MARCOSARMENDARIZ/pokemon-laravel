FROM php:8.2-fpm

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    nginx \
    && docker-php-ext-install pdo pdo_mysql

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Directorio de trabajo
WORKDIR /var/www/html

# Copiar proyecto
COPY . .

# Instalar dependencias Laravel
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Permisos
RUN chown -R www-data:www-data storage bootstrap/cache

# Copiar configuración de nginx
COPY nginx/default.conf /etc/nginx/conf.d/default.conf

# Limpiar cache
RUN php artisan config:clear \
 && php artisan route:clear \
 && php artisan view:clear

# Render usa $PORT (no 80)
EXPOSE 10000

# Iniciar PHP-FPM + Nginx
CMD php-fpm -D && nginx -g "daemon off;"

