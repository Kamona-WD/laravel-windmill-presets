<?php

namespace WindmillPresets;

use Illuminate\Support\ServiceProvider;
use Laravel\Ui\UiCommand;
use WindmillPresets\WindmillPresets;

class WindmillPresetsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        UiCommand::macro('windmill', function ($command) {
            WindmillPresets::install();

            $command->info('Windmill scaffolding installed successfully.');

            if ($command->option('auth')) {
                WindmillPresets::installAuth();

                $command->info('Windmill auth scaffolding installed successfully.');
            }

            $command->comment('Please run "npm install && npm run dev" to compile your fresh scaffolding.');
        });
    }

    public function register()
    {
        //
    }
}
