FROM php:7.2-cli
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN apt-get update && apt-get install -y git zip unzip
WORKDIR /usr/src/cipher-cli
COPY composer.lock .
COPY composer.json .
RUN composer install
COPY . .
CMD [ "php", "cipher" ]
