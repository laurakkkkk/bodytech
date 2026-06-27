FROM php:8.2-apache

# Habilitar mod_rewrite
RUN a2enmod rewrite

# Instalar extensiones necesarias
RUN apt-get update && apt-get install -y \
        libzip-dev \
        unzip \
    && docker-php-ext-install zip

# Copiar todos los archivos al servidor
COPY . /var/www/html/

# Configurar Apache para que sirva index.html/index.php
RUN echo "DirectoryIndex index.php index.html" >> /etc/apache2/apache2.conf

# Configurar para permitir .htaccess
RUN echo "AllowOverride All" >> /etc/apache2/apache2.conf

# Dar permisos
RUN chown -R www-data:www-data /var/www/html/

EXPOSE 10000

CMD ["apache2-foreground"]
