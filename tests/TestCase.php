<?php

namespace UrlHive\Laravel\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use UrlHive\Laravel\UrlHiveServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            UrlHiveServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('urlhive.base_url', 'https://api.urlhive.com/v1');
        $app['config']->set('urlhive.api_token', 'test-token');
    }
}
