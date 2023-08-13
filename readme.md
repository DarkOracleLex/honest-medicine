## Разворачивание приложения

- docker compose up --build

В контейнере php:

- composer install
- cp .env.example .env
- php artisan app:install
- php artisan key:generate
- ввести токен в postman