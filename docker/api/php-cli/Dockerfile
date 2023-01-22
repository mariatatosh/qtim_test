FROM php:8.1-cli-alpine

RUN apk update \
    && apk --no-cache add autoconf g++ make git bash \
    && apk add --update linux-headers \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-install pdo pdo_mysql

COPY ./conf.d $PHP_INI_DIR/conf.d

RUN curl -sS https://getcomposer.org/installer | php --  --install-dir=/usr/bin --filename=composer \
    && mkdir /.composer/ \
    && chmod 777 /.composer/

# install symfony-cli
RUN curl -sS https://get.symfony.com/cli/installer | bash \
    && mv /root/.symfony5/bin/symfony /usr/local/bin/symfony \
    && mkdir -m777 /.symfony/

WORKDIR /app