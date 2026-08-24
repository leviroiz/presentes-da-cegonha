FROM php:8.2-apache

RUN docker-php-ext-install mysqli
RUN a2enmod headers rewrite \
    && sed -ri 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

WORKDIR /var/www/html
COPY . /var/www/html

EXPOSE 80
