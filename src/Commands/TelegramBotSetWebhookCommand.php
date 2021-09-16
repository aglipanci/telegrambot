<?php

namespace AgliPanci\TelegramBot\Commands;

use Illuminate\Console\Command;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Telegram;

class TelegramBotSetWebhookCommand extends Command
{
    protected $signature = 'telegram:set:webhook';

    protected $description = 'Set Webhook URL to the Telegram Bot.';

    public function handle()
    {
        try {
            $result = Telegram::setWebhook(config('telegram.webhook_url'));

            if ($result->isOk()) {
                $this->info($result->getDescription());
            }
        } catch (TelegramException $e) {
            $this->error($e->getMessage());
        }
    }
}