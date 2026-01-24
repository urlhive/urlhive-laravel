<?php

namespace UrlHive\Laravel\Resources;

use UrlHive\Laravel\UrlHiveClient;

class AnalyticsResource
{
    protected UrlHiveClient $client;

    public function __construct(UrlHiveClient $client)
    {
        $this->client = $client;
    }

    /**
     * Get URL statistics.
     *
     * @param string $code
     * @return array
     */
    public function stats(string $code): array
    {
        return $this->client->getHttpClient()
            ->get("/urls/{$code}/stats")
            ->throw()
            ->json();
    }
}
