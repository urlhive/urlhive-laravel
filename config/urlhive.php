<?php

return [
    /*
    |--------------------------------------------------------------------------
    | URLHive API Configuration
    |--------------------------------------------------------------------------
    |
    | Here you can configure your URLHive API settings. You can find your
    | API token in your URLHive dashboard settings.
    |
    */

    'base_url' => env('URLHIVE_API_URL', 'https://urlhive.com/api/v1'),

    'api_token' => env('URLHIVE_API_TOKEN'),

    'timeout' => 15, // seconds
];
