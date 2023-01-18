FROM php:8.1-cli-alpine

RUN mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini

RUN apk update && \
    apk add --no-cache \
    git \
    bash

RUN curl -sS https://getcomposer.org/installer | php --  --install-dir=/usr/bin --filename=composer

# install symfony-cli
RUN curl -sS https://get.symfony.com/cli/installer | bash \
    && mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

WORKDIR /app