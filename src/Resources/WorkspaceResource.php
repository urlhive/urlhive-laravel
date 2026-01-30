<?php

namespace UrlHive\Laravel\Resources;

use UrlHive\Laravel\UrlHiveClient;

class WorkspaceResource
{
    protected UrlHiveClient $client;

    public function __construct(UrlHiveClient $client)
    {
        $this->client = $client;
    }

    /**
     * List Workspaces.
     *
     * @return array
     */
    public function list(): array
    {
        return $this->client->getHttpClient()
            ->get('/v1/workspaces')
            ->throw()
            ->json();
    }

    /**
     * Create a Workspace.
     *
     * @param array $data
     * @return array
     */
    public function create(array $data): array
    {
        return $this->client->getHttpClient()
            ->post('/v1/workspaces', $data)
            ->throw()
            ->json();
    }

    /**
     * Update a Workspace.
     *
     * @param string $id
     * @param array $data
     * @return array
     */
    public function update(string $id, array $data): array
    {
        return $this->client->getHttpClient()
            ->patch("/v1/workspaces/{$id}", $data)
            ->throw()
            ->json();
    }

    /**
     * Switch Workspace.
     *
     * @param string $id
     * @return array
     */
    public function switch(string $id): array
    {
        return $this->client->getHttpClient()
            ->post("/v1/workspaces/{$id}/switch")
            ->throw()
            ->json();
    }
}
