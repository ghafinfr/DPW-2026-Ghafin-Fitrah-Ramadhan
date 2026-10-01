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

CMD ["bash", "-c", "rm -f /etc/apache2/mods-enabled/mpm_event.conf /etc/apache2/mods-enabled/mpm_event.load /etc/apache2/mods-enabled/mpm_worker.conf /etc/apache2/mods-enabled/mpm_worker.load; rm -f /etc/apache2/mods-enabled/mpm_event /etc/apache2/mods-enabled/mpm_worker; a2enmod mpm_prefork; echo '=== MPM AFTER CLEANUP ==='; ls -la /etc/apache2/mods-enabled/mpm*; echo '=== START APACHE ==='; apache2-foreground"]