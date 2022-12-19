FROM php:8.0-fpm

USER root

#COPY composer.lock composer.json /var/www/app/

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
	libssh-dev


# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
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

#RUN docker-php-source extract \
#    && mkdir /usr/src/php/ext/amqp \
#    && curl -L https://github.com/php-amqp/php-amqp/archive/master.tar.gz | tar -xzC /usr/src/php/ext/amqp --strip-components=1
#RUN docker-php-ext-install amqp
#RUN docker-php-ext-enable amqp

RUN pecl install xdebug
RUN pecl install amqp
RUN docker-php-ext-enable amqp

# Install composer
RUN curl --silent --show-error https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy existing application directory contents
COPY ./www/ /var/www/app

ENV COMPOSER_ALLOW_SUPERUSER 1

RUN composer install --ignore-platform-reqs

# Copy existing application directory permissions
COPY --chown=www:www . /var/www/app

EXPOSE 80
CMD ["/usr/local/sbin/php-fpm", "--nodaemonize"]