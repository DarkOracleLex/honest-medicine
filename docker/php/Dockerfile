FROM php:8.1-fpm-alpine

WORKDIR /var/www

# Устанавливанием необходимые пакеты
RUN apk update && apk add --no-cache \
    bash \
    shadow \
    libpq-dev \
    autoconf \
    gcc \
    make \
    g++ \
    linux-headers

# Устанавливаем composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Устанавливаем необходимые php расширения
RUN docker-php-ext-install pdo pdo_pgsql bcmath

# Устанавливаем Xdebug
RUN pecl install xdebug && docker-php-ext-enable xdebug

# Создаём пользователя и группу www для приложения Laravel
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# RUN supervisorctl reread

# Меняем пользователя на www
USER www

# В контейнере открываем 9000 порт
EXPOSE 9000
CMD ["php-fpm"]
