<?php

namespace UrlHive\Laravel\Resources;

use UrlHive\Laravel\UrlHiveClient;

class BioResource
{
    protected UrlHiveClient $client;

    public function __construct(UrlHiveClient $client)
    {
        $this->client = $client;
    }

    /**
     * Get Bio Page details.
     *
     * @return array
     */
    public function show(): array
    {
        return $this->client->getHttpClient()
            ->get('/bio')
            ->throw()
            ->json();
    }

    /**
     * Create or update Bio Page.
     *
     * @param array $data
     * @return array
     */
    public function store(array $data): array
    {
        return $this->client->getHttpClient()
            ->post('/bio', $data)
            ->throw()
            ->json();
    }

    /**
     * Add a link to Bio Page.
     *
     * @param array $data
     * @return array
     */
    public function addLink(array $data): array
    {
        return $this->client->getHttpClient()
            ->post('/bio/links', $data)
            ->throw()
            ->json();
    }
}
