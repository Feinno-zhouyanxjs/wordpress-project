FROM php:8.2-apache

# Install required PHP extensions and tools
RUN apt-get update && apt-get install -y unzip curl libpng-dev libjpeg-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install mysqli pdo pdo_mysql zip

# Enable Apache rewrite module
RUN a2enmod rewrite

RUN docker-php-ext-install opcache

# 🔥 Allow .htaccess override for mod_rewrite to work
RUN sed -i 's/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Configure Apache to use port 8080 for Cloud Run
ENV PORT=8080
EXPOSE 8080
RUN sed -i 's/80/${PORT}/g' /etc/apache2/ports.conf \
 && sed -i 's/80/${PORT}/g' /etc/apache2/sites-available/000-default.conf

# PHP upload size limit
COPY uploads.ini /usr/local/etc/php/conf.d/uploads.ini

# Copy your full WordPress source
COPY wordpress/ /var/www/html/

# 🔥 Include .htaccess for REST API and permalinks
COPY htaccess /var/www/html/.htaccess

# Copy wp-config that reads DB + domain from env
COPY wp-config.php /var/www/html/wp-config.php

# Fix permissions
RUN chown -R www-data:www-data /var/www/html