# Kalau base => development, di docker-compose di set sebagai berikut:
#    build:
#      target: base

# Kalau deploy => production, di docker-compose di set sebagai berikut:
#    build:
#      target: deploy

FROM --platform=linux/amd64 php:8.1.5-apache-buster as base

# Install dependencies & extensions
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libicu-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    libssl-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-configure intl \
    && docker-php-ext-install -j$(nproc) gd

# Install mongodb via pecl.
RUN pecl install mongodb

# Install php extension
RUN docker-php-ext-install pdo_mysql zip exif pcntl intl opcache

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Remove Cache
RUN rm -rf /var/cache/apt/* && rm -rf /tmp/*

# Add UID '1000' to www-data
RUN usermod -u 1000 www-data

# Disable warning
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Enable module dan restart apache nya
RUN a2enmod rewrite && service apache2 restart

# Alias codeception
RUN echo 'alias c="vendor/bin/codecept"' >> /etc/bash.bashrc

# Baris ini akan di ekseksusi 
# kalau target di set deploy (server)
FROM base AS deploy

RUN a2enmod ssl && service apache2 restart

# Copy semua file
COPY . .
COPY ./web/index-prod.php web/index.php

# Copy settingan - settingan
COPY ./.docker/php/php.ini /usr/local/etc/php/php.ini
COPY ./.docker/php/debian-apache/000-default-prod.conf /etc/apache2/sites-available/000-default.conf

RUN mkdir ./runtime ./web/assets && \
    rm -rf .docker && \
    echo "*\n!.gitignore" | tee ./runtime/.gitignore ./web/assets/.gitignore && \
    chown -R www-data:www-data ./web/.well-known && \
    chown www-data:www-data ./runtime && \
    chgrp www-data ./web/assets && \
    chmod g+w ./web/assets