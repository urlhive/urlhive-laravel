<?php

use Illuminate\Support\Facades\Http;
use UrlHive\Laravel\Facades\UrlHive;

it('can list urls', function () {
    Http::fake([
        '*/urls*' => Http::response([
            'data' => [
                ['short_code' => 'test1'],
                ['short_code' => 'test2'],
            ]
        ], 200),
    ]);

    $response = UrlHive::url()->list();

    expect($response['data'])->toHaveCount(2);
});

it('can toggle url status', function () {
    Http::fake([
        '*/urls/test/toggle' => Http::response(['active' => false], 200),
    ]);

    $response = UrlHive::url()->toggle('test');

    expect($response['active'])->toBeFalse();
});

it('can export url stats', function () {
    Http::fake([
        '*/urls/test/export' => Http::response('date,clicks', 200),
    ]);

    $response = UrlHive::url()->export('test');

    expect($response)->toBe('date,clicks');
});

it('can update bio link', function () {
    Http::fake([
        '*/bio/links/123' => Http::response(['success' => true], 200),
    ]);

    $response = UrlHive::bio()->updateLink('123', ['title' => 'New Title']);

    expect($response['success'])->toBeTrue();
});

it('can delete bio link', function () {
    Http::fake([
        '*/bio/links/123' => Http::response([], 200),
    ]);

    $response = UrlHive::bio()->deleteLink('123');

    expect($response)->toBeTrue();
});

it('can reorder bio links', function () {
    Http::fake([
        '*/bio/links/reorder' => Http::response(['success' => true], 200),
    ]);

    $response = UrlHive::bio()->reorderLinks(['1', '3', '2']);

    expect($response['success'])->toBeTrue();
});

it('can track bio link click', function () {
    Http::fake([
        '*/bio/links/123/click' => Http::response(['success' => true], 200),
    ]);

    $response = UrlHive::bio()->trackClick('123');

    expect($response['success'])->toBeTrue();
});

it('can create link list', function () {
    Http::fake([
        '*/link-lists' => Http::response(['id' => 'list-123'], 201),
    ]);

    $response = UrlHive::linkLists()->create(['name' => 'My List']);

    expect($response['id'])->toBe('list-123');
});

it('can list link lists', function () {
    Http::fake([
        '*/link-lists' => Http::response(['data' => []], 200),
    ]);

    $response = UrlHive::linkLists()->list();

    expect($response['data'])->toBeArray();
});

it('can update link list', function () {
    Http::fake([
        '*/link-lists/list-123' => Http::response(['success' => true], 200),
    ]);

    $response = UrlHive::linkLists()->update('list-123', ['name' => 'Updated Name']);

    expect($response['success'])->toBeTrue();
});

it('can delete link list', function () {
    Http::fake([
        '*/link-lists/list-123' => Http::response([], 200),
    ]);

    $response = UrlHive::linkLists()->delete('list-123');

    expect($response)->toBeTrue();
});

it('can add item to link list', function () {
    Http::fake([
        '*/link-lists/list-123/items' => Http::response(['id' => 'item-123'], 201),
    ]);

    $response = UrlHive::linkLists()->addItem('list-123', ['url' => 'https://example.com']);

    expect($response['id'])->toBe('item-123');
});

it('can update link list item', function () {
    Http::fake([
        '*/link-lists/items/item-123' => Http::response(['success' => true], 200),
    ]);

    $response = UrlHive::linkLists()->updateItem('item-123', ['title' => 'New Title']);

    expect($response['success'])->toBeTrue();
});

it('can delete link list item', function () {
    Http::fake([
        '*/link-lists/items/item-123' => Http::response([], 200),
    ]);

    $response = UrlHive::linkLists()->deleteItem('item-123');

    expect($response)->toBeTrue();
});

it('can track link list item click', function () {
    Http::fake([
        '*/link-lists/items/item-123/click' => Http::response(['success' => true], 200),
    ]);

    $response = UrlHive::linkLists()->trackItemClick('item-123');

    expect($response['success'])->toBeTrue();
});

it('can create workspace', function () {
    Http::fake([
        '*/workspaces' => Http::response(['id' => 'ws-123'], 201),
    ]);

    $response = UrlHive::workspaces()->create(['name' => 'My Workspace']);

    expect($response['id'])->toBe('ws-123');
});

it('can update workspace', function () {
    Http::fake([
        '*/workspaces/ws-123' => Http::response(['success' => true], 200),
    ]);

    $response = UrlHive::workspaces()->update('ws-123', ['name' => 'Updated Workspace']);

    expect($response['success'])->toBeTrue();
});

it('can switch workspace', function () {
    Http::fake([
        '*/workspaces/ws-123/switch' => Http::response(['success' => true], 200),
    ]);

    $response = UrlHive::workspaces()->switch('ws-123');

    expect($response['success'])->toBeTrue();
});

it('can create pixel', function () {
    Http::fake([
        '*/pixels' => Http::response(['id' => 'pix-123'], 201),
    ]);

    $response = UrlHive::pixels()->create(['name' => 'FB Pixel', 'type' => 'facebook']);

    expect($response['id'])->toBe('pix-123');
});

it('can list pixels', function () {
    Http::fake([
        '*/pixels' => Http::response(['data' => []], 200),
    ]);

    $response = UrlHive::pixels()->list();

    expect($response['data'])->toBeArray();
});
