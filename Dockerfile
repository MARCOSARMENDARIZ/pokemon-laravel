FROM php:8.2

# Instalar dependencias del sistema + Node
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    nodejs \
    npm \
    && docker-php-ext-install pdo pdo_mysql

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Directorio de trabajo
WORKDIR /var/www/html

# Copiar proyecto
COPY . .

# Instalar dependencias backend
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# 🔥 VITE (ESTO ES LO QUE FALTABA) 🔥
RUN npm install
RUN npm run build

# Permisos
RUN chown -R www-data:www-data storage bootstrap/cache

# Limpiar cache Laravel
RUN php artisan config:clear \
 && php artisan route:clear \
 && php artisan view:clear

# Render usa $PORT
EXPOSE 10000

# Comando correcto para Render
CMD php artisan serve --host=0.0.0.0 --port=$PORT
