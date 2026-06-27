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

# Configurar Apache correctamente
RUN echo "DirectoryIndex index.html index.php" >> /etc/apache2/apache2.conf

# **CORRECCIÓN: AllowOverride dentro de un bloque Directory**
RUN echo "<Directory /var/www/html/>" >> /etc/apache2/apache2.conf && \
    echo "    AllowOverride All" >> /etc/apache2/apache2.conf && \
    echo "</Directory>" >> /etc/apache2/apache2.conf

# Dar permisos
RUN chown -R www-data:www-data /var/www/html/

EXPOSE 10000

CMD ["apache2-foreground"]
