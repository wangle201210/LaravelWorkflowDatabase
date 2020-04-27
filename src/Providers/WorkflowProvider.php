<?php

namespace Wanna\LaravelWorkflowDatabase\Providers;

use Illuminate\Support\ServiceProvider;

class WorkflowProvider extends ServiceProvider
{
    public function boot()
    {
        if (!file_exists(config_path('wanna.php'))) {
            $this->publishes([
                dirname(__DIR__) . '/config/wanna.php' => config_path('wanna.php'),
            ], 'config');
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(
            dirname(__DIR__) . '/config/wanna.php', 'wanna'
        );
    }
}
