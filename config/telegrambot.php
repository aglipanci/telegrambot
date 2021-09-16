<?php

return [
    'api_key' => env('TELEGRAMBOT_API_KEY'),
    'username' => env('TELEGRAMBOT_USERNAME'),
    'webhook_url' => env('TELEGRAMBOT_WEBHOOK_URL'),
    'commands_dir' => app_path('Bot/Commands')
];
