<?php

namespace UrlHive\Laravel\Resources;

use UrlHive\Laravel\UrlHiveClient;

class LinkListResource
{
    protected UrlHiveClient $client;

    public function __construct(UrlHiveClient $client)
    {
        $this->client = $client;
    }

    /**
     * List Link Lists.
     *
     * @return array
     */
    public function list(): array
    {
        return $this->client->getHttpClient()
            ->get('/link-lists')
            ->throw()
            ->json();
    }

    /**
     * Create a Link List.
     *
     * @param array $data
     * @return array
     */
    public function create(array $data): array
    {
        return $this->client->getHttpClient()
            ->post('/link-lists', $data)
            ->throw()
            ->json();
    }

    /**
     * Get Link List Details.
     *
     * @param string $id
     * @return array
     */
    public function get(string $id): array
    {
        return $this->client->getHttpClient()
            ->get("/link-lists/{$id}")
            ->throw()
            ->json();
    }

    /**
     * Update Link List.
     *
     * @param string $id
     * @param array $data
     * @return array
     */
    public function update(string $id, array $data): array
    {
        return $this->client->getHttpClient()
            ->patch("/link-lists/{$id}", $data)
            ->throw()
            ->json();
    }

    /**
     * Delete Link List.
     *
     * @param string $id
     * @return bool
     */
    public function delete(string $id): bool
    {
        return $this->client->getHttpClient()
            ->delete("/link-lists/{$id}")
            ->throw()
            ->successful();
    }

    /**
     * Add Item to List.
     *
     * @param string $id
     * @param array $data
     * @return array
     */
    public function addItem(string $id, array $data): array
    {
        return $this->client->getHttpClient()
            ->post("/link-lists/{$id}/items", $data)
            ->throw()
            ->json();
    }

    /**
     * Update List Item.
     *
     * @param string $itemId
     * @param array $data
     * @return array
     */
    public function updateItem(string $itemId, array $data): array
    {
        return $this->client->getHttpClient()
            ->patch("/link-lists/items/{$itemId}", $data)
            ->throw()
            ->json();
    }

    /**
     * Remove Item from List.
     *
     * @param string $itemId
     * @return bool
     */
    public function deleteItem(string $itemId): bool
    {
        return $this->client->getHttpClient()
            ->delete("/link-lists/items/{$itemId}")
            ->throw()
            ->successful();
    }

    /**
     * Track Link List Item Click.
     *
     * @param string $id
     * @return array
     */
    public function trackItemClick(string $id): array
    {
        return $this->client->getHttpClient()
            ->post("/link-lists/items/{$id}/click")
            ->throw()
            ->json();
    }
}
