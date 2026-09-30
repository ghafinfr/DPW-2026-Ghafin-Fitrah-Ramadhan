FROM php:8.2-apache

RUN apt-get update \
    && apt-get install -y --no-install-recommends libpq-dev \
    && docker-php-ext-install pdo_pgsql \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

COPY Praktikum/jobsheet-10/ /var/www/html/

RUN chown -R www-data:www-data /var/www/html

RUN sed -i 's/Listen 80/Listen 8000/' /etc/apache2/ports.conf \
    && sed -i 's/:80>/:8000>/' /etc/apache2/sites-available/000-default.conf

EXPOSE 8000

CMD ["apache2-foreground"]