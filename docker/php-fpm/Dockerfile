FROM php:8.2.0-fpm-alpine
# Install default packages
RUN apk add --no-cache bash curl git zlib-dev build-base oniguruma-dev autoconf rabbitmq-c rabbitmq-c-dev
# Install required packages for xdebug
RUN apk add --update linux-headers
# Install packages for database (postgres) interaction
RUN apk add --no-cache libpq-dev && docker-php-ext-install pdo_pgsql
# Install MongoDB and amqp extension
RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS \
        && pecl install mongodb amqp \
        && docker-php-ext-enable mongodb \
        && docker-php-ext-enable amqp \
        && apk del .build-deps
# Install xdebug
ARG ENABLE_XDEBUG=false
RUN if [ "${ENABLE_XDEBUG}" = "true" ]; \
    then \
        pecl install xdebug && docker-php-ext-enable xdebug ; \
    fi;
COPY docker/php-fpm/dev/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
# Set permissions
ARG PUID=1000
ARG GUID=1000
RUN apk add --no-cache shadow && \
  groupmod -o -g ${GUID} www-data && \
  usermod -o -u ${PUID} -g www-data www-data
# Set workdir
COPY ./ /var/www
WORKDIR /var/www
# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

CMD php-fpm