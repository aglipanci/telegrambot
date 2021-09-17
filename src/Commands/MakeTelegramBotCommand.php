<?php

namespace AgliPanci\TelegramBot\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class MakeTelegramBotCommand extends GeneratorCommand
{
    protected $name = 'make:bot-command';

    protected $description = 'Create a new TelegramBot command';

    protected $type = 'TelegramBot Command';

    protected function getStub()
    {
        return __DIR__ . '/../../stubs/command.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        $commandsDir = config('telegrambot.commands_dir');
        $commandsNamespace = Str::of($commandsDir)
            ->remove(app_path())
            ->replace('/', '\\');

        return $rootNamespace . '\\' . $commandsNamespace;
    }
}
