<?php

use Illuminate\Support\Facades\Http;
use UrlHive\Laravel\UrlHiveClient;
use GuzzleHttp\Promise\PromiseInterface;

it('can mix async and sync requests safely', function () {
    Http::fake([
        '*' => Http::response(['data' => ['short_url' => 'https://urlhive.com/test']], 200),
    ]);

    $client = new UrlHiveClient([
        'base_url' => 'https://api.test',
        'api_token' => 'token'
    ]);

    // 1. Start an async request
    // This should NOT affect the client's internal state for subsequent requests
    $promise = $client->getHttpClient()->async()->get('/async');

    expect($promise)->toBeInstanceOf(PromiseInterface::class);

    // 2. Make a synchronous call using a Resource
    // This should succeed and not crash
    $response = $client->url()->shorten('https://example.com');

    expect($response)->toBeArray();
    expect($response['data']['short_url'])->toBe('https://urlhive.com/test');

    // 3. Ensure the promise can still be settled
    $promise->wait();
});
