FROM alpine:3.8

ARG UID=1000
ARG GID=1000
ARG XDEBUG=1

RUN apk add --update --no-cache curl \
    php7 \
    php7-cli \
    php7-iconv \
    php7-bcmath \
    php7-json \
    php7-xml \
    php7-xmlwriter \
    php7-simplexml \
    php7-dom \
    php7-mbstring \
    php7-mcrypt \
    php7-ctype \
    php7-pdo \
    php7-pdo_mysql \
    php7-sqlite3 \
    php7-phar \
    php7-tokenizer \
    php7-fileinfo \
    php7-xdebug \
    php7-curl \
    php7-intl \
    php7-redis \
    git \
    openssh \
    sqlite \
    && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && \
    composer global require hirak/prestissimo

# Install Xdebug
RUN if [ "$XDEBUG" = "1" ]; then \
    apk add --update --no-cache php7-xdebug; \
    fi
COPY ./config/xdebug.ini /etc/php7/conf.d/xdebug-dev.ini


RUN addgroup -g ${GID} www-data && \
    adduser -D -u ${UID} -G www-data www-data

WORKDIR /var/www

USER www-data

RUN mkdir -p ~/.ssh/ && \
   echo -e "Host bitbucket.org\n\tStrictHostKeyChecking no\n" >> ~/.ssh/config

EXPOSE 9000
CMD ["php"]
