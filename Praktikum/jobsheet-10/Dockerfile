FROM php:8.2-apache

# Install PostgreSQL extension
RUN apt-get update \
    && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo_pgsql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Aktifkan rewrite
RUN a2enmod rewrite

# Copy seluruh aplikasi Jobsheet 10
COPY . /var/www/html/

# Permission
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80