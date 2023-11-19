FROM php:8.2-fpm


ADD https://github.com/mlocati/docker-php-extension-installer/releases/download/1.2.26/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions

RUN apt-get update && apt-get install -y \
    gcc \
    musl-dev \
    autoconf \
    zlib1g-dev \
    unzip \
    libzip-dev \
    libxml2-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    && docker-php-ext-install -j$(nproc) pdo pdo_mysql bcmath zip pcntl



RUN apt-get update && apt-get install -y libpng-dev
RUN apt-get install -y \
    libwebp-dev \
    libjpeg62-turbo-dev \
    libpng-dev libxpm-dev \
    libfreetype6-dev





# Installing composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php && php -r "unlink('composer-setup.php');" \
    && mv composer.phar /usr/local/bin/composer
