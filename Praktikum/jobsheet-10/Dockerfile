FROM php:8.2-apache-bookworm

# Install PostgreSQL extension
RUN apt-get update \
    && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo_pgsql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Pastikan hanya satu MPM Apache yang aktif
RUN rm -f /etc/apache2/mods-enabled/mpm_event.* \
          /etc/apache2/mods-enabled/mpm_worker.* \
          /etc/apache2/mods-enabled/mpm_prefork.* \
    && a2enmod mpm_prefork \
    && a2enmod rewrite \
    && apache2ctl -M | grep mpm

# Copy aplikasi Jobsheet 10
COPY . /var/www/html/

# Permission
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80

CMD ["apache2-foreground"]