FROM php:7.3-cli
MAINTAINER Sooraj Rughooputh <soorajrug@googlemail.com>

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"

RUN mv composer.phar /usr/local/bin/composer

RUN apt-get update
RUN apt-get install -y bash git unzip zip zlib1g-dev
RUN docker-php-ext-install zip
