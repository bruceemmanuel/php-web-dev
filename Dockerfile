FROM php:7.1.27-apache-jessie

LABEL maintainer="Bruce E. Sueira"

COPY .docker/php/php.ini /usr/local/etc/php/
COPY .docker/apache/vhost.conf /etc/apache2/sites-available/000-default.conf
COPY .docker/php/xdebug-dev.ini /usr/local/etc/php/conf.d/xdebug-dev.ini

RUN docker-php-ext-install pdo_mysql && \
    docker-php-ext-install opcache && \
    apt-get update && \
    apt-get install libldap2-dev -y && \
    rm -rf /var/lib/apt/lists/* && \
    docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu/ && \
    docker-php-ext-install ldap

RUN pecl install xdebug-2.5.1
RUN docker-php-ext-enable xdebug
RUN a2enmod rewrite negotiation

ENV TZ=America/Sao_Paulo
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

WORKDIR /srv/app