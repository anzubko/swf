FROM alpine:3.19.1

EXPOSE 9000

WORKDIR /var/www

RUN apk -q update && apk add -q --no-cache \
icu-data-full \
msmtp \
php83 \
php83-fpm \
php83-apcu \
php83-calendar \
php83-ctype \
php83-curl \
php83-dom \
php83-exif \
php83-ffi \
php83-fileinfo \
php83-ftp \
php83-gd \
php83-gettext \
php83-iconv \
php83-pecl-imagick \
php83-imap \
php83-intl \
php83-mbstring \
php83-pecl-memcached \
php83-mysqli \
php83-openssl \
php83-pcntl \
php83-pgsql \
php83-phar \
php83-posix \
php83-shmop \
php83-simplexml \
php83-sockets \
php83-sodium \
php83-sysvmsg \
php83-sysvsem \
php83-sysvshm \
php83-tokenizer \
php83-xml \
php83-xmlreader \
php83-xmlwriter \
php83-xsl \
php83-opcache \
php83-zip

RUN ln -s /usr/bin/php83 /usr/bin/php

CMD php-fpm83
