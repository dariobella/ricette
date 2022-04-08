FROM php:8-fpm
RUN apt-get update && apt-get install -y libonig-dev git zip unzip zlib1g-dev libzip-dev
RUN docker-php-ext-install pdo_mysql mbstring zip
RUN mkdir /app
VOLUME /app
WORKDIR /app
EXPOSE 9000
CMD php -S 0.0.0.0:9000
