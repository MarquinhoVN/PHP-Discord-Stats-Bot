FROM php:8.2-cli

RUN apt-get update && apt-get install -y git unzip libpq-dev libcurl4-openssl-dev zip \
    && docker-php-ext-install pdo pdo_pgsql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app
COPY . .

RUN composer install --no-dev --optimize-autoloader

CMD ["php", "bot/bot.php"]
