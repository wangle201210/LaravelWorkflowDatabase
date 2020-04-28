<?php

namespace Wanna\LaravelWorkflowDatabase\Providers;

use Illuminate\Support\ServiceProvider;

class WorkflowProvider extends ServiceProvider
{
    public function boot()
    {
        if (!file_exists(config_path('wanna.php'))) {
            $this->publishes([
                dirname(__DIR__) . '/Config/wanna.php' => config_path('wanna.php'),
            ], 'config');
        }

        $this->publishes([
            dirname(__DIR__) . '/Database/2020_04_28_110946_create_workflows_table.php' => database_path('migrations') . "/2020_04_28_110946_create_workflows_table.php",
        ], 'migrations');
        $this->registerRouter();
    }

    public function register()
    {
        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/wanna.php', 'wanna'
        );
    }
    private function registerRouter()
    {
        if (strpos($this->app->version(), 'Lumen') === false && !$this->app->routesAreCached()) {
            app('router')->middleware('api')->group(dirname(__DIR__) . '/routes.php');
        } else {
            require dirname(__DIR__) . '/routes.php';
        }
    }
}
