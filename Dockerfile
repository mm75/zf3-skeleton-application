FROM php:7.1-rc-apache

RUN apt-get update \
 && apt-get install -y git zlib1g-dev \
         libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng12-dev \
        libpq-dev \
        libxml2-dev \
        libcurl4-gnutls-dev \
        curl \
 && docker-php-ext-install zip \
 && docker-php-ext-install -j$(nproc) iconv mcrypt \
 && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
 && docker-php-ext-install -j$(nproc) gd \
 && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
 && docker-php-ext-install pdo \
 && docker-php-ext-install pdo_pgsql \
 && docker-php-ext-install pgsql \
 && docker-php-ext-install pdo_mysql \
 && docker-php-ext-install soap \
 && docker-php-ext-install json \
 && docker-php-ext-install curl \
 && docker-php-ext-install mbstring \
 && a2enmod rewrite \
 && sed -i 's!/var/www/html!/var/www/public!g' /etc/apache2/sites-enabled/000-default.conf \
 && curl -sS https://getcomposer.org/installer \
  | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www