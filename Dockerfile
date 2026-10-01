FROM php:8.2-apache

# Install PostgreSQL dependency
RUN apt-get update \
    && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo_pgsql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Bersihkan semua konfigurasi MPM Apache
RUN find /etc/apache2 -type f \( \
        -name 'mpm_event.*' -o \
        -name 'mpm_worker.*' -o \
        -name 'mpm_prefork.*' \
    \) -delete

# Buat konfigurasi MPM prefork
RUN printf '%s\n' \
    '<IfModule !mpm_prefork_module>' \
    '    LoadModule mpm_prefork_module /usr/lib/apache2/modules/mod_mpm_prefork.so' \
    '</IfModule>' \
    > /etc/apache2/mods-enabled/mpm_prefork.load

# Aktifkan rewrite
RUN a2enmod rewrite

# Hapus halaman bawaan Apache
RUN rm -rf /var/www/html/*

# Copy Jobsheet 10
COPY Praktikum/jobsheet-10/ /var/www/html/

# Permission
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80