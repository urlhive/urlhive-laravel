<?php

namespace UrlHive\Laravel\Resources;

use UrlHive\Laravel\UrlHiveClient;

class UrlResource
{
    protected UrlHiveClient $client;

    public function __construct(UrlHiveClient $client)
    {
        $this->client = $client;
    }

    /**
     * Shorten a URL.
     *
     * @param string $url The original URL to shorten.
     * @param array $options Optional data like custom alias, expiration, etc.
     * @return array
     */
    public function shorten(string $url, array $options = []): array
    {
        $payload = array_merge(['url' => $url], $options);

        return $this->client->getHttpClient()
            ->post('/shorten', $payload)
            ->throw()
            ->json();
    }

    /**
     * Get URL details.
     *
     * @param string $code
     * @return array
     */
    public function get(string $code): array
    {
        return $this->client->getHttpClient()
            ->get("/urls/{$code}")
            ->throw()
            ->json();
    }

    /**
     * List URLs.
     *
     * @param array $params
     * @return array
     */
    public function list(array $params = []): array
    {
        return $this->client->getHttpClient()
            ->get('/urls', $params)
            ->throw()
            ->json();
    }

    /**
     * Update a URL.
     *
     * @param string $code
     * @param array $data
     * @return array
     */
    public function update(string $code, array $data): array
    {
        return $this->client->getHttpClient()
            ->patch("/urls/{$code}", $data)
            ->throw()
            ->json();
    }

    /**
     * Delete a URL.
     *
     * @param string $code
     * @return bool
     */
    public function delete(string $code): bool
    {
        return $this->client->getHttpClient()
            ->delete("/urls/{$code}")
            ->throw()
            ->successful();
    }

    /**
     * Toggle URL status.
     *
     * @param string $code
     * @return array
     */
    public function toggle(string $code): array
    {
        return $this->client->getHttpClient()
            ->patch("/urls/{$code}/toggle")
            ->throw()
            ->json();
    }

    /**
     * Export URL statistics.
     *
     * @param string $code
     * @return string
     */
    public function export(string $code): string
    {
        return $this->client->getHttpClient()
            ->get("/urls/{$code}/export")
            ->throw()
            ->body();
    }
}
