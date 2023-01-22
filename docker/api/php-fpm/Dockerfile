FROM php:8.1-fpm-alpine

RUN apk --no-cache add autoconf g++ make \
    && apk add --update linux-headers \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-install pdo pdo_mysql

COPY ./conf.d $PHP_INI_DIR/conf.d

WORKDIR /app