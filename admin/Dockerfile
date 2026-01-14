FROM php:8.2-apache

# Install mysqli
RUN docker-php-ext-install mysqli

# Enable mod_rewrite
RUN a2enmod rewrite

# Set document root
WORKDIR /var/www/html

# Copy seluruh backend API
COPY . /var/www/html/

# Permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 777 /var/www/html/bukti \
    && chmod -R 777 /var/www/html/gambar \

