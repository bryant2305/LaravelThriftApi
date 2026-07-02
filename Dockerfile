# Stage 1: Build dependencies
FROM php:8.1-apache as dependencies

# Instala herramientas necesarias para Composer y extensiones de PHP
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    && rm -rf /var/lib/apt/lists/*

# Instala extensiones de PHP necesarias
RUN docker-php-ext-install pdo pdo_mysql

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Habilita el módulo de reescritura de Apache
RUN a2enmod rewrite

WORKDIR /var/www/html

# Copia solo composer.json y composer.lock para instalar dependencias
COPY composer.json composer.lock ./

# Instala dependencias de PHP
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Stage 2: Production image
FROM php:8.1-apache

# Instala extensiones necesarias
RUN docker-php-ext-install pdo pdo_mysql

# Habilita módulos Apache
RUN a2enmod rewrite

# Configura el directorio raíz de Apache en 'public'
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf

WORKDIR /var/www/html

# Copia vendor y archivos compilados del stage anterior
COPY --from=dependencies /var/www/html/vendor ./vendor

# Copia el resto de la aplicación
COPY . .

# Ajusta permisos
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Exponer puerto 80
EXPOSE 80
