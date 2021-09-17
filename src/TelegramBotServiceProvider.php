<?php

namespace AgliPanci\TelegramBot;

use AgliPanci\TelegramBot\Commands\MakeTelegramBotCommand;
use AgliPanci\TelegramBot\Commands\TelegramBotSetWebhookCommand;
use AgliPanci\TelegramBot\Http\Controllers\TelegramBotWebhookController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Longman\TelegramBot\Telegram;

class TelegramBotServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                TelegramBotSetWebhookCommand::class,
                MakeTelegramBotCommand::class
            ]);
        }

        $this->publishes([
            __DIR__ . '/../config/telegrambot.php' => config_path('telegrambot.php'),
        ], 'config');

        Route::macro('telegrambot', function (string $url, string $name = 'telegrambot') {
            Route::post($url, TelegramBotWebhookController::class)->name($name);
        });
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/telegrambot.php', 'telegrambot');

        $this->app->singleton('telegram', function () {
            $telegram = new Telegram(config('telegrambot.api_key'), config('telegrambot.username'));
            $telegram->addCommandsPath(config('telegrambot.commands_dir'));

            return $telegram;
        });
    }
}
