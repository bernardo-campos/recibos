FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
    libicu-dev \
    libonig-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install \
        intl \
        mbstring \
        pdo_mysql \
        zip \
    && curl -sS https://getcomposer.org/installer | php -- --version=2.3.5 --install-dir=/usr/local/bin --filename=composer

WORKDIR /app

COPY . /app

RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs
RUN composer dump-autoload
RUN cp .env.example .env
RUN php artisan key:generate
RUN php artisan config:cache
#RUN php artisan migrate --seed --force

#CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
CMD ["sh", "-c", "php artisan serve --host=0.0.0.0 --port=8000"]

# en la consola ejecutar los comandos
# docker-compose exec app php artisan migrate:fresh --seed
# docker-compose exec app php artisan config:cache
