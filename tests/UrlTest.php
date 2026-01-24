<?php

use Illuminate\Support\Facades\Http;
use UrlHive\Laravel\Facades\UrlHive;

it('can shorten a url', function () {
    Http::fake([
        '*/shorten' => Http::response([
            'data' => [
                'short_url' => 'https://urlhive.com/test',
                'short_code' => 'test'
            ]
        ], 200),
    ]);

    $response = UrlHive::url()->shorten('https://example.com');

    expect($response['data']['short_url'])->toBe('https://urlhive.com/test');
});

it('can get url stats', function () {
    Http::fake([
        '*/urls/test/stats' => Http::response([
            'data' => [
                'clicks' => 100
            ]
        ], 200),
    ]);

    $stats = UrlHive::analytics()->stats('test');

    expect($stats['data']['clicks'])->toBe(100);
});
