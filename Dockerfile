FROM php:8.2-apache

# Install PostgreSQL PDO
RUN docker-php-ext-install pdo pdo_pgsql

# Aktifkan mod_rewrite Apache
RUN a2enmod rewrite

# Hapus isi web root bawaan Apache
RUN rm -rf /var/www/html/*

# Salin jobsheet-10 ke web root
COPY Praktikum/jobsheet-10/ /var/www/html/

# Permission
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80