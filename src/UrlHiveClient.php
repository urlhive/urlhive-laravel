<?php

namespace UrlHive\Laravel;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\PendingRequest;
use UrlHive\Laravel\Resources\UrlResource;
use UrlHive\Laravel\Resources\BioResource;
use UrlHive\Laravel\Resources\AnalyticsResource;

class UrlHiveClient
{
    protected array $config;
    protected ?PendingRequest $http = null;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    protected function http(): PendingRequest
    {
        if (!$this->http) {
            $this->http = Http::baseUrl($this->config['base_url'])
                ->withToken($this->config['api_token'])
                ->timeout($this->config['timeout'] ?? 15)
                ->acceptJson()
                ->asJson();
        }

        return $this->http;
    }

    public function getHttpClient(): PendingRequest
    {
        return $this->http();
    }

    public function url(): UrlResource
    {
        return new UrlResource($this);
    }

    public function bio(): BioResource
    {
        return new BioResource($this);
    }

    public function analytics(): AnalyticsResource
    {
        return new AnalyticsResource($this);
    }
}
