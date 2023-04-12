FROM php:8.2-fpm

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libzip-dev \
    libpq-dev \
    libxml2-dev \
    supervisor 

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && echo "xdebug.mode=coverage" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

RUN echo '[program:horizon] \n\
process_name=%(program_name)s \n\
command=php /var/www/app/artisan horizon \n\
autostart=true \n\
autorestart=true \n\
user=root \n\
redirect_stderr=true \n\
stdout_logfile=/var/www/app/storage/logs/worker.log \n\
stopwaitsecs=3600' >> /etc/supervisor/conf.d/horizon.conf

RUN docker-php-ext-install pdo
RUN docker-php-ext-enable pdo

RUN docker-php-ext-install pgsql
RUN docker-php-ext-enable pgsql

RUN docker-php-ext-install pdo_pgsql
RUN docker-php-ext-enable pdo_pgsql

RUN docker-php-ext-install gd
RUN docker-php-ext-enable gd

RUN docker-php-ext-install zip
RUN docker-php-ext-enable zip

RUN docker-php-ext-install iconv
RUN docker-php-ext-enable iconv

RUN docker-php-ext-install simplexml
RUN docker-php-ext-enable simplexml

RUN docker-php-ext-install xml
RUN docker-php-ext-enable xml

RUN docker-php-ext-install pcntl
RUN docker-php-ext-enable pcntl

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ENV COMPOSER_ALLOW_SUPERUSER 1

ENV COMPOSER_HOME /composer

ENV PATH $PATH:/composer/vendor/bin

COPY ./server-init.sh .

RUN chmod -R 775 server-init.sh

