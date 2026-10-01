FROM php:8.2-apache

# Install PostgreSQL
RUN apt-get update \
    && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo_pgsql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Aktifkan rewrite saja
RUN a2enmod rewrite

# Hapus file bawaan Apache
RUN rm -rf /var/www/html/*

# Copy aplikasi Jobsheet 10
COPY Praktikum/jobsheet-10/ /var/www/html/

# Permission
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80