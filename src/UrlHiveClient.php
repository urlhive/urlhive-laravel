<?php

namespace UrlHive\Laravel;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\PendingRequest;
use UrlHive\Laravel\Resources\LinkListResource;
use UrlHive\Laravel\Resources\PixelResource;
use UrlHive\Laravel\Resources\UrlResource;
use UrlHive\Laravel\Resources\BioResource;
use UrlHive\Laravel\Resources\AnalyticsResource;
use UrlHive\Laravel\Resources\WorkspaceResource;

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
            $baseUrl = $this->config['base_url'] ?? 'https://api.urlhive.net';
            $this->http = Http::baseUrl($baseUrl)
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

    public function linkLists(): LinkListResource
    {
        return new LinkListResource($this);
    }

    public function workspaces(): WorkspaceResource
    {
        return new WorkspaceResource($this);
    }

    public function pixels(): PixelResource
    {
        return new PixelResource($this);
    }
}
