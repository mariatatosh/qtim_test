FROM php:8.1-fpm-alpine

RUN docker-php-ext-install pdo pdo_mysql

COPY ./conf.d $PHP_INI_DIR/conf.d

WORKDIR /app