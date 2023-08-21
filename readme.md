## Разворачивание приложения

- docker compose up --build

В контейнере php:

- composer install
- cp .env.example .env в laravel
- php artisan app:install
- php artisan key:generate
- cp .env.example .env в vue
- ввести токен в ./src/vue/.env