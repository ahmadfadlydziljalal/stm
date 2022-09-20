# Kalau base => development, di docker-compose di set sebagai berikut:
#    build:
#      target: base

# Kalau deploy => production, di docker-compose di set sebagai berikut:
#    build:
#      target: deploy

FROM php:8.1.5-apache-buster as base

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

# Aktifkan sebagai user www-data
USER www-data

# Copy settingan - settingan
COPY ./.docker/php/php.ini /usr/local/etc/php/php.ini
COPY ./.docker/php/debian-apache/000-default.conf /etc/apache2/sites-available/000-default.conf

# Baris ini akan di ekseksusi kalau target di set deploy
FROM base AS deploy
COPY --chown=www-data:www-data ./assets assets
COPY --chown=www-data:www-data ./commands commands
COPY --chown=www-data:www-data ./components components
COPY --chown=www-data:www-data ./config config
COPY --chown=www-data:www-data ./controllers controllers
COPY --chown=www-data:www-data ./mail mail
COPY --chown=www-data:www-data ./migrations migrations
COPY --chown=www-data:www-data ./models models
COPY --chown=www-data:www-data ./runtime runtime
COPY --chown=www-data:www-data ./themes themes
COPY --chown=www-data:www-data ./vendor vendor
COPY --chown=www-data:www-data ./views views
COPY --chown=www-data:www-data ./web web
COPY --chown=www-data:www-data ./widgets widgets

COPY ./yii yii
COPY --chown=www-data:www-data ./web/index-prod.php web/index.php