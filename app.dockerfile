FROM php:7.2-fpm

RUN apt-get update \
    && apt-get -y install gcc make autoconf libc-dev pkg-config \
    && apt-get install -y libmcrypt-dev \
    mysql-client libmagickwand-dev --no-install-recommends \
    && pecl install imagick \
    && pecl install mcrypt-1.0.1 \
    && docker-php-ext-enable imagick \
    && docker-php-ext-enable mcrypt \
    && docker-php-ext-install pdo_mysql

### Install and run bower

# RUN sudo apt-get install yum* \
#     && curl --silent --location https://rpm.nodesource.com/setup_9.x | bash - \
#     && apt-get install -y nodejs

# Install bower
# RUN npm install --global bower

# Install adminlte
# RUN bower install admin-lte