FROM php:8.2-apache-bookworm

RUN apt-get update \
    && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo_pgsql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN rm -f /etc/apache2/mods-enabled/mpm_event.* \
          /etc/apache2/mods-enabled/mpm_worker.* \
          /etc/apache2/mods-enabled/mpm_prefork.* \
    && a2enmod mpm_prefork \
    && a2enmod rewrite \
    && apache2ctl -M | grep mpm

COPY . /var/www/html/

RUN chown -R www-data:www-data /var/www/html

EXPOSE 80

CMD ["bash", "-c", "echo '=== MPM CONFIG ==='; ls -la /etc/apache2/mods-enabled/mpm*; echo '=== APACHE MODULES ==='; apache2ctl -M 2>&1 | grep mpm; echo '=== START APACHE ==='; apache2-foreground"]