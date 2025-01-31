FROM php:8.4-fpm

USER root

WORKDIR /var/www/app

RUN apt-get update && apt-get install -y \
    git \
    libzip-dev \
    libc-client-dev \
    libkrb5-dev \
    libpng-dev \
    libjpeg-dev \
    libwebp-dev \
    libfreetype6-dev \
    libkrb5-dev \
    libicu-dev \
    zlib1g-dev \
    zip \
    ffmpeg \
    libmemcached11 \
    libmemcachedutil2 \
    build-essential \
    libmemcached-dev \
    gnupg2 \
    libpq-dev \
    libpq5 \
    libz-dev \
    libcurl4-openssl-dev \
    libonig-dev \
    libbz2-dev \
	mc \
	librabbitmq-dev \
	libssh-dev \
	nodejs npm


RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install bcmath
RUN docker-php-ext-install sockets
RUN docker-php-ext-install curl
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install ftp
RUN docker-php-ext-install posix

RUN docker-php-ext-configure gd \
    --with-webp=/usr/include/ \
    --with-freetype=/usr/include/ \
    --with-jpeg=/usr/include/
RUN docker-php-ext-install gd

RUN docker-php-ext-configure zip
RUN docker-php-ext-install zip

RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl

RUN docker-php-ext-install opcache

RUN docker-php-ext-install pdo_mysql exif pcntl

RUN pecl install xdebug
RUN pecl install amqp
RUN docker-php-ext-enable amqp
RUN pecl install redis
RUN docker-php-ext-enable redis

#COPY ./www/ /var/www/app

#COPY --chown=www:www . /var/www/app

EXPOSE 80
CMD ["/usr/local/sbin/php-fpm", "--nodaemonize"]