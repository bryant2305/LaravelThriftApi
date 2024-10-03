# Usa la imagen base de PHP con Apache
FROM php:8.1-apache

# Instala extensiones necesarias para Laravel
RUN docker-php-ext-install pdo pdo_mysql

# Habilita el módulo de reescritura de Apache
RUN a2enmod rewrite

# Configura el directorio raíz de Apache en 'public'
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Actualiza la configuración de Apache para que el DocumentRoot sea 'public'
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf

# Copia los archivos de tu aplicación Laravel al directorio dentro del contenedor
COPY . /var/www/html

# Ajusta permisos
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html
RUN composer install

# Exponer el puerto 80
EXPOSE 80
