FROM php:7.1.4
ENV XDEBUGINI=/usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
ARG host
RUN pecl install xdebug-2.5.0 \
    && docker-php-ext-install opcache \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-enable opcache

RUN sed -i '1 a xdebug.remote_autostart=true' $XDEBUGINI
RUN sed -i '1 a xdebug.remote_handler=dbgp' $XDEBUGINI
RUN sed -i '1 a xdebug.remote_connect_back=0 ' $XDEBUGINI
RUN sed -i '1 a xdebug.remote_port=9000' $XDEBUGINI
RUN sed -i '1 a xdebug.remote_host=$host' $XDEBUGINI
RUN sed -i '1 a xdebug.remote_enable=1' $XDEBUGINI
RUN sed -i '1 a xdebug.idekey=docker' $XDEBUGINI
RUN cp /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini /usr/local/etc/php/php.ini-development