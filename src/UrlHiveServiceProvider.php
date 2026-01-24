<?php

namespace UrlHive\Laravel;

use Illuminate\Support\ServiceProvider;

class UrlHiveServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/urlhive.php' => config_path('urlhive.php'),
            ], 'urlhive-config');
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/urlhive.php', 'urlhive');

        $this->app->singleton('urlhive', function ($app) {
            return new UrlHiveClient(config('urlhive'));
        });
    }
}
