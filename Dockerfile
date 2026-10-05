FROM node:24 AS node-builder

WORKDIR /app

COPY package.json package-lock.json ./

RUN npm install

COPY . .

RUN npm run build




FROM php:8.4-cli
COPY --from=composer:2.8 /usr/bin/composer /usr/bin/composer
RUN apt-get update \
    && apt-get install -y libsqlite3-dev unzip libzip-dev \
    && docker-php-ext-install pdo_sqlite zip
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-scripts
COPY . .
COPY --from=node-builder /app/public/build /app/public/build
CMD ["php", "artisan", "serve", "--host=0.0.0.0"]
