<?php

namespace UrlHive\Laravel;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Client\PendingRequest;
use GuzzleHttp\Client as GuzzleClient;
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
    protected ?GuzzleClient $guzzleClient = null;
    protected ?UrlResource $url = null;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    protected function http(): PendingRequest
    {
        if (!$this->http) {
            $baseUrl = $this->config['base_url'] ?? 'https://api.urlhive.net';

            // Use persistent client unless running unit tests (to support Http::fake)
            $usePersistentClient = true;
            if (class_exists(App::class)) {
                try {
                     if (App::runningUnitTests()) {
                         $usePersistentClient = false;
                     }
                } catch (\Throwable $e) {
                    // Ignore if App facade fails or method doesn't exist
                }
            }

            if ($usePersistentClient) {
                if (!$this->guzzleClient) {
                    $this->guzzleClient = new GuzzleClient([
                        'base_uri' => $baseUrl,
                        'timeout' => $this->config['timeout'] ?? 15,
                    ]);
                }
            }

            $pendingRequest = Http::baseUrl($baseUrl);

            if ($usePersistentClient) {
                $pendingRequest->setClient($this->guzzleClient);
            }

            $this->http = $pendingRequest
                ->withToken($this->config['api_token'])
                ->timeout($this->config['timeout'] ?? 15)
                ->acceptJson()
                ->asJson();
        }

        return $this->http;
    }

    public function getHttpClient(): PendingRequest
    {
        return clone $this->http();
    }

    public function url(): UrlResource
    {
        if (!$this->url) {
            $this->url = new UrlResource($this);
        }

        return $this->url;
    }

    public function bio(): BioResource
    {
        return new BioResource($this);
    }

    public function analytics(): AnalyticsResource
    {
        return new AnalyticsResource($this);
    }

    public function linkList(): LinkListResource
    {
        return new LinkListResource($this);
    }

    public function workspace(): WorkspaceResource
    {
        return new WorkspaceResource($this);
    }

    public function pixel(): PixelResource
    {
        return new PixelResource($this);
    }
}
