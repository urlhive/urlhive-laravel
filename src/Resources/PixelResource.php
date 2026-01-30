<?php

namespace UrlHive\Laravel\Resources;

use UrlHive\Laravel\UrlHiveClient;

class PixelResource
{
    protected UrlHiveClient $client;

    public function __construct(UrlHiveClient $client)
    {
        $this->client = $client;
    }

    /**
     * List Pixels.
     *
     * @return array
     */
    public function list(): array
    {
        return $this->client->getHttpClient()
            ->get('/v1/pixels')
            ->throw()
            ->json();
    }

    /**
     * Create a Pixel.
     *
     * @param array $data
     * @return array
     */
    public function create(array $data): array
    {
        return $this->client->getHttpClient()
            ->post('/v1/pixels', $data)
            ->throw()
            ->json();
    }

    /**
     * Get Pixel Details.
     *
     * @param string $id
     * @return array
     */
    public function get(string $id): array
    {
        return $this->client->getHttpClient()
            ->get("/v1/pixels/{$id}")
            ->throw()
            ->json();
    }

    /**
     * Update Pixel.
     *
     * @param string $id
     * @param array $data
     * @return array
     */
    public function update(string $id, array $data): array
    {
        return $this->client->getHttpClient()
            ->patch("/v1/pixels/{$id}", $data)
            ->throw()
            ->json();
    }

    /**
     * Delete Pixel.
     *
     * @param string $id
     * @return bool
     */
    public function delete(string $id): bool
    {
        return $this->client->getHttpClient()
            ->delete("/v1/pixels/{$id}")
            ->throw()
            ->successful();
    }
}
