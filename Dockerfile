FROM php:8.1-fpm-alpine

RUN docker-php-ext-install pdo
RUN curl -sS https://getcomposer.org/installer​ | php -- \
    --install-dir=/usr/local/bin --filename=composer

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . /app
RUN composer install

EXPOSE 8080

CMD php yii serve 0.0.0.0 --port=8080