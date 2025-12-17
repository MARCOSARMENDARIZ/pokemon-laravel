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

# 🔥 BORRAR SITIO DEFAULT DE NGINX (ESTA ES LA CLAVE)
RUN rm -f /etc/nginx/sites-enabled/default \
    && rm -f /etc/nginx/sites-available/default

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Directorio de trabajo
WORKDIR /var/www/html

# Copiar proyecto
COPY . .

# Instalar dependencias de Laravel
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Permisos
RUN chown -R www-data:www-data storage bootstrap/cache

# Copiar configuración de Nginx
COPY nginx/default.conf /etc/nginx/conf.d/default.conf

# PHP-FPM
COPY docker/php-fpm.conf /usr/local/etc/php-fpm.d/www.conf

# Iniciar PHP-FPM + Nginx
CMD php-fpm -D && nginx -g "daemon off;"
