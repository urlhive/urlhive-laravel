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
            ->get("/v1/urls/{$code}/stats")
            ->throw()
            ->json();
    }
    /**
     * Track a conversion (S2S).
     *
     * @param array $data
     * @return array
     */
    public function trackConversion(array $data): array
    {
        return $this->client->getHttpClient()
            ->post('/v1/track/conversion', $data)
            ->throw()
            ->json();
    }

    /**
     * Get customer journey.
     *
     * @param string $hiveId
     * @return array
     */
    public function journey(string $hiveId): array
    {
        return $this->client->getHttpClient()
            ->get("/v1/analytics/journey/{$hiveId}")
            ->throw()
            ->json();
    }
}
