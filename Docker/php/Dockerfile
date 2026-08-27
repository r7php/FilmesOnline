FROM php:8.2-fpm

# Instala dependências do sistema
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Instala as dependências PHP durante o build da imagem.
COPY composer.json composer.lock ./
RUN composer install --no-interaction --prefer-dist --no-progress --optimize-autoloader --no-scripts

COPY . .

RUN composer dump-autoload --optimize

RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 9000

CMD ["php-fpm"]
