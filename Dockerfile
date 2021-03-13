FROM php:7.3-alpine

ARG USER_ID=1000
ARG GROUP_ID=1000
ARG GITHUB_ACCESS_TOKEN=""

# Install packages
RUN apk --update add wget \
        sudo \
        git \
        zlib-dev \
        libmemcached-dev \
        vim \
        libxml2-dev \
        libzip-dev \
        build-base \
        autoconf \
        && pecl channel-update pecl.php.net \
        && pecl install xdebug memcached \
        && docker-php-ext-install zip pdo_mysql \
        && docker-php-ext-enable xdebug memcached \
        && rm -rf /var/cache/apk/* \
        && mkdir -p /var/www/html

RUN echo "user ALL=(root) NOPASSWD:ALL" > /etc/sudoers.d/user && \
    chmod 0440 /etc/sudoers.d/user

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
