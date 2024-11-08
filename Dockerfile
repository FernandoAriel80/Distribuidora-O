# Etapa 1: Construcción de assets del frontend
FROM node:18 AS build-frontend
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# Etapa 2: Configuración de Laravel con PHP y Nginx
FROM php:8.2-fpm AS backend
WORKDIR /var/www/html

# Instala las extensiones de PHP necesarias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    curl \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Copia los archivos de Laravel
COPY . .

# Copia los assets del frontend generados en la etapa anterior
COPY --from=build-frontend /app/public/js /var/www/html/public/js
COPY --from=build-frontend /app/public/css /var/www/html/public/css

# Instala las dependencias de Laravel
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --optimize-autoloader --no-dev

# Genera la clave de aplicación de Laravel
RUN php artisan key:generate

# Configura los permisos adecuados
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expone el puerto para Nginx
EXPOSE 80

CMD ["php-fpm"]
