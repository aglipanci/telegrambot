<?php

namespace AgliPanci\TelegramBot\Commands;

use AgliPanci\TelegramBot\Http\Controllers\TelegramBotWebhookController;
use Illuminate\Console\Command;
use Illuminate\Routing\Router;
use Longman\TelegramBot\Exception\TelegramException;
use AgliPanci\TelegramBot\Facades\Telegram;

class TelegramBotSetWebhookCommand extends Command
{
    protected $signature = 'telegram:set:webhook';

    protected $description = 'Set Webhook URL to the Telegram Bot.';

    public function handle()
    {
        $routeName = app(Router::class)
            ->getRoutes()
            ->getByAction(TelegramBotWebhookController::class)
            ?->getName();

        $url = $routeName ? route($routeName) : config('telegrambot.webhook_url');

        if (!$url) {
            $this->error('URL not found.');
        }

        try {
            $result = Telegram::setWebhook($url);

            if ($result->isOk()) {
                $this->info($result->getDescription());
            }
        } catch (TelegramException $e) {
            $this->error($e->getMessage());
        }
    }
}
