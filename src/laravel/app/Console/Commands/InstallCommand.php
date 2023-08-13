<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class InstallCommand extends Command
{
    protected $signature = 'app:install';

    protected $description = 'Установка приложения';

    public function handle(): void
    {
        Artisan::call('migrate --seed');

        $this->info('Создание пользователя:');

        $name = $this->ask('Введите имя');
        $email = $this->ask('Введите email');
        $pass = $this->ask('Введите пароль');

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => $pass,
        ]);

        $token = $user->createToken('create')->plainTextToken;
        $this->info("Ваш токен $token");
    }
}
