FROM php:7.4-cli-buster

COPY . /app
WORKDIR /app
RUN apt-get update && apt-get install -y wget \
    && .docker/composer-install.sh \
    && composer -vvv install \
    && vendor/bin/phpunit

CMD [ "php", "./hierarchy.php" ]