FROM php:7.2-cli
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN apt-get update && apt-get install -y git zip unzip
COPY . /usr/src/cipher-cli
WORKDIR /usr/src/cipher-cli
RUN composer install
CMD [ "php", "./cipher" ]
