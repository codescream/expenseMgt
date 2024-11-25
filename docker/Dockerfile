FROM php:8.0.2-fpm

RUN apt-get update && apt-get install -y \
git \
curl \
zip \
unzip

COPY nginx/php.ini /usr/local/etc/php/php.ini

RUN curl -sS https://getcomposer.org/installer | php -- \
--install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www