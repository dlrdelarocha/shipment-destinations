FROM php:8.0-cli

WORKDIR app

COPY composer.json composer.lock ./

COPY main.php ./

RUN apt-get update && apt-get install -y zip unzip
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
