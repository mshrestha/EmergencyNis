FROM php:7.2-fpm-alpine
RUN apk update; \
    apk upgrade; \
    apk add libpng-dev;

# Enable php extensions
RUN docker-php-ext-install pdo pdo_mysql mysqli mbstring gd zip

# WORKDIR /var/www/html

# Add composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Downgrade to composer verion 1, comment this if you need version 2
RUN composer self-update --1