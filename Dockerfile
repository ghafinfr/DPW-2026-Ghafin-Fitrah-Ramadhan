FROM php:8.2-apache

# Install PostgreSQL dependency
RUN apt-get update \
    && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Hapus semua MPM Apache yang aktif
RUN rm -f /etc/apache2/mods-enabled/mpm_*.load \
          /etc/apache2/mods-enabled/mpm_*.conf \
    && a2enmod mpm_prefork \
    && a2enmod rewrite

# Hapus file bawaan Apache
RUN rm -rf /var/www/html/*

# Gunakan Jobsheet 10 sebagai website utama
COPY Praktikum/jobsheet-10/ /var/www/html/

# Permission
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80