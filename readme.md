Laravel Telegram Bot API Wrapper
==========================

> This package is a simple Laravel wrapper for the [Official Telegram Bot API][link-telegram-bot-api].

## Installation

```bash
composer require aglipanci/telegrambot
```

## Configurations

#### Env
In order for the Telegram Bot to work you need to add the following values to your .env file:

```dotenv
TELEGRAMBOT_API_KEY=api-key-here
TELEGRAMBOT_USERNAME=bot-username-here
TELEGRAMBOT_WEBHOOK_URL=webhook-url-here
```

#### Config
To publish the package configuration file, execute the following artisan command:

```bash
php artisan vendor:publish --provider="AgliPanci\TelegramBot\TelegramBotServiceProvider"
```

The main Telegram class from `Longman\TelegramBot\Telegram` will be available as a facade through `AgliPanci\TelegramBot\Facades\Telegram` and all the original methods can be called statically from everywhere. For example:
```php
use \AgliPanci\TelegramBot\Facades\Telegram;
use Longman\TelegramBot\Entities\Update;
use Longman\TelegramBot\Telegram as TelegramBot

Telegram::setUpdateFilter(function (Update $update, TelegramBot $telegram, &$reason = 'Update denied by update_filter') {
    $user_id = $update->getMessage()->getFrom()->getId();
    if ($user_id === 428) {
        return true;
    }

    $reason = "Invalid user with ID {$user_id}";
    return false;
});
```

#### Webhook Route
On your web.php or api.php add the following line:
```php
Route::telegrambot('telegram');
```
If you are using the package route and controller you don't need to populate `TELEGRAMBOT_WEBHOOK_URL`.

#### Setting Webhook
After populating `.env` file with the API credentials and webhook URL you need to execute the following command to setup the Webhook URL:
```bash
php artisan telegram:set:webhook
```

Now you are ready to process requests by the Telegram Bot.

## Commands
### Defaults
The default path for the commands it's Bot/Commands insider your App directory. That can be changed in the `telegrambot.php` by changing the commands_dir key.
```php
'commands_dir' => app_path('Bot/Commands')
```

### Generating Commands
You can generate classes for your commands using the artisan command:
```bash
php artisan telegram:make:command SomethingCommand
```
This will generate the command structure on the specified command directory (the default is `App/Bot/Commands`). After generating the command the system will be ready to process `/something` from your users.


For more details on how the [Official Telegram Bot API][link-telegram-bot-api] works please read their official documentation.

[link-telegram-bot-api]: https://github.com/php-telegram-bot/core
