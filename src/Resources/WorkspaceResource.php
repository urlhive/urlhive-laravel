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
    /**
     * Delete a Workspace.
     *
     * @param string $id
     * @return bool
     */
    public function delete(string $id): bool
    {
        return $this->client->getHttpClient()
            ->delete("/v1/workspaces/{$id}")
            ->throw()
            ->successful();
    }

    /**
     * Get Workspace members.
     *
     * @param string $id
     * @return array
     */
    public function members(string $id): array
    {
        return $this->client->getHttpClient()
            ->get("/v1/workspaces/{$id}/members")
            ->throw()
            ->json();
    }

    /**
     * Invite a member to Workspace.
     *
     * @param string $id
     * @param array $data
     * @return array
     */
    public function invite(string $id, array $data): array
    {
        return $this->client->getHttpClient()
            ->post("/v1/workspaces/{$id}/invitations", $data)
            ->throw()
            ->json();
    }

    /**
     * Cancel an invitation.
     *
     * @param string $invitationId
     * @return bool
     */
    public function cancelInvitation(string $invitationId): bool
    {
        return $this->client->getHttpClient()
            ->delete("/v1/workspaces/invitations/{$invitationId}")
            ->throw()
            ->successful();
    }

    /**
     * Remove a member from Workspace.
     *
     * @param string $id
     * @param string $userId
     * @return bool
     */
    public function removeMember(string $id, string $userId): bool
    {
        return $this->client->getHttpClient()
            ->delete("/v1/workspaces/{$id}/members/{$userId}")
            ->throw()
            ->successful();
    }

    /**
     * List Workspace roles.
     *
     * @param string $id
     * @return array
     */
    public function roles(string $id): array
    {
        return $this->client->getHttpClient()
            ->get("/v1/workspaces/{$id}/roles")
            ->throw()
            ->json();
    }

    /**
     * Create a Workspace role.
     *
     * @param string $id
     * @param array $data
     * @return array
     */
    public function createRole(string $id, array $data): array
    {
        return $this->client->getHttpClient()
            ->post("/v1/workspaces/{$id}/roles", $data)
            ->throw()
            ->json();
    }

    /**
     * Update a Workspace role.
     *
     * @param string $id
     * @param string $roleId
     * @param array $data
     * @return array
     */
    public function updateRole(string $id, string $roleId, array $data): array
    {
        return $this->client->getHttpClient()
            ->patch("/v1/workspaces/{$id}/roles/{$roleId}", $data)
            ->throw()
            ->json();
    }

    /**
     * Delete a Workspace role.
     *
     * @param string $id
     * @param string $roleId
     * @return bool
     */
    public function deleteRole(string $id, string $roleId): bool
    {
        return $this->client->getHttpClient()
            ->delete("/v1/workspaces/{$id}/roles/{$roleId}")
            ->throw()
            ->successful();
    }
}
