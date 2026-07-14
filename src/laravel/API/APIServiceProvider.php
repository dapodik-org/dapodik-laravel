<?php

namespace Dapodik\Laravel\API;

use Illuminate\Support\ServiceProvider;

class APIServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/dapodik-api.php', 'dapodik-api');

        $this->app->singleton('dapodik.api.laravel', function ($app) {
            return new APIManager($app);
        });
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/config/dapodik-api.php' => config_path('dapodik-api.php'),
            ], 'dapodik-api-config');
        }
    }
}
