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
            ->get('/v1/bio')
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
            ->post('/v1/bio', $data)
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
            ->post('/v1/bio/links', $data)
            ->throw()
            ->json();
    }

    /**
     * Update a link in Bio Page.
     *
     * @param string $id
     * @param array $data
     * @return array
     */
    public function updateLink(string $id, array $data): array
    {
        return $this->client->getHttpClient()
            ->patch("/v1/bio/links/{$id}", $data)
            ->throw()
            ->json();
    }

    /**
     * Remove a link from Bio Page.
     *
     * @param string $id
     * @return bool
     */
    public function deleteLink(string $id): bool
    {
        return $this->client->getHttpClient()
            ->delete("/v1/bio/links/{$id}")
            ->throw()
            ->successful();
    }

    /**
     * Track Bio Link Click.
     *
     * @param string $id
     * @return array
     */
    public function trackClick(string $id): array
    {
        return $this->client->getHttpClient()
            ->post("/v1/bio/links/{$id}/click")
            ->throw()
            ->json();
    }

    /**
     * Reorder Bio Links.
     *
     * @param array $order Array of link IDs.
     * @return array
     */
    public function reorderLinks(array $order): array
    {
        return $this->client->getHttpClient()
            ->post('/v1/bio/links/reorder', ['order' => $order])
            ->throw()
            ->json();
    }
    /**
     * Get Bio Page statistics.
     *
     * @param array $params
     * @return array
     */
    public function stats(array $params = []): array
    {
        return $this->client->getHttpClient()
            ->get('/v1/bio/stats', $params)
            ->throw()
            ->json();
    }

    /**
     * Export Bio Page analytics.
     *
     * @return string
     */
    public function export(): string
    {
        return $this->client->getHttpClient()
            ->get('/v1/bio/export')
            ->throw()
            ->body();
    }

    /**
     * Get Bio Link statistics.
     *
     * @param string $id
     * @return array
     */
    public function linkStats(string $id): array
    {
        return $this->client->getHttpClient()
            ->get("/v1/bio/links/{$id}/stats")
            ->throw()
            ->json();
    }
}
