FROM php:8.1-fpm as php

ENV PHP_OPCACHE_ENABLE=1
ENV PHP_OPCACHE_ENABLE_CLI=0
ENV PHP_OPCACHE_VALIDATE_TIMESTAMPS=1
ENV PHP_OPCACHE_REVALIDATE_FREQ=1
ENV APP_USER=giga
# RUN usermod -u 1000 www-data

RUN apt-get update && apt-get install -y \
  unzip \
  libpq-dev \
  libcurl4-gnutls-dev \
  nginx \
  postgresql \
  curl

RUN docker-php-ext-install pdo pdo_pgsql bcmath opcache

RUN useradd -u 1000 $APP_USER

RUN mkdir /var/www/gigaprog
RUN chown -R $APP_USER:$APP_USER /var/www/gigaprog
RUN mkdir /var/www/gigaprog/pgsql-data
RUN chown -R $APP_USER:$APP_USER /var/www/gigaprog/pgsql-data

WORKDIR /var/www/gigaprog

# COPY --chown=www-data . .

COPY ./docker/php/php.ini /usr/local/etc/php/php.ini
COPY ./docker/php/php-fpm.conf /usr/local/etc/php-fpm.d/www.conf
COPY ./docker/nginx/nginx.conf /etc/nginx/nginx.conf

COPY --from=composer:2.3.5 /usr/bin/composer /usr/bin/composer

#RUN php artisan cache:clear
#RUN php artisan config:clear
#
#RUN chmod -R 755 /var/www/storage
#RUN chmod -R 755 /var/www/bootstrap

# USER giga

ENTRYPOINT [ "docker/entrypoint.sh" ]
