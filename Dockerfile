FROM php:8.2-apache

# Install dependency PostgreSQL
RUN apt-get update \
    && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Aktifkan mod_rewrite Apache
RUN a2enmod rewrite

# Hapus file bawaan Apache
RUN rm -rf /var/www/html/*

# Gunakan Jobsheet 10 sebagai website utama
COPY Praktikum/jobsheet-10/ /var/www/html/

# Atur permission
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80