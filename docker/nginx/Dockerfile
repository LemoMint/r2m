FROM nginx:alpine
# Copy nginx config files
COPY nginx.conf /etc/nginx/
COPY default.conf /etc/nginx/conf.d/
# Install required packges
RUN apk add --no-cache bash
# Set permissions
RUN set -x ; \
    addgroup -g 82 -S www-data ; \
    adduser -u 82 -D -S -G www-data www-data && exit 0 ; exit 1
# Set upstream server
ARG PHP_FPM_UPSTREAM_CONTAINER=php-fpm
ARG PHP_UPSTREAM_PORT=9000
RUN echo "upstream php-upstream {server ${PHP_FPM_UPSTREAM_CONTAINER}:${PHP_UPSTREAM_PORT};}" > /etc/nginx/conf.d/upstream.conf

EXPOSE 80