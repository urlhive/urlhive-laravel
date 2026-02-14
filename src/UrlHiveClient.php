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
    protected ?BioResource $bio = null;
    protected ?AnalyticsResource $analytics = null;
    protected ?LinkListResource $linkList = null;
    protected ?WorkspaceResource $workspace = null;
    protected ?PixelResource $pixel = null;

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
        if (!$this->bio) {
            $this->bio = new BioResource($this);
        }

        return $this->bio;
    }

    public function analytics(): AnalyticsResource
    {
        if (!$this->analytics) {
            $this->analytics = new AnalyticsResource($this);
        }

        return $this->analytics;
    }

    public function linkList(): LinkListResource
    {
        if (!$this->linkList) {
            $this->linkList = new LinkListResource($this);
        }

        return $this->linkList;
    }

    public function workspace(): WorkspaceResource
    {
        if (!$this->workspace) {
            $this->workspace = new WorkspaceResource($this);
        }

        return $this->workspace;
    }

    public function pixel(): PixelResource
    {
        if (!$this->pixel) {
            $this->pixel = new PixelResource($this);
        }

        return $this->pixel;
    }
}
