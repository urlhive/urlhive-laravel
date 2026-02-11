<?php

use Illuminate\Support\Facades\Http;
use UrlHive\Laravel\Facades\UrlHive;

it('can get url conversions', function () {
    Http::fake([
        '*/urls/test/conversions' => Http::response(['data' => []], 200),
    ]);
    $response = UrlHive::url()->conversions('test');
    expect($response)->toBeArray();
});

it('can track straight-to-server conversion', function () {
    Http::fake([
        '*/track/conversion' => Http::response(['success' => true], 200),
    ]);
    $response = UrlHive::analytics()->trackConversion(['hive_id' => 'abc', 'event_name' => 'purchase']);
    expect($response['success'])->toBeTrue();
});

it('can get customer journey', function () {
    Http::fake([
        '*/analytics/journey/abc' => Http::response(['data' => []], 200),
    ]);
    $response = UrlHive::analytics()->journey('abc');
    expect($response)->toBeArray();
});

it('can get bio stats', function () {
    Http::fake([
        '*/bio/stats' => Http::response(['data' => []], 200),
    ]);
    $response = UrlHive::bio()->stats();
    expect($response)->toBeArray();
});

it('can export bio analytics', function () {
    Http::fake([
        '*/bio/export' => Http::response('csv,data', 200),
    ]);
    $response = UrlHive::bio()->export();
    expect($response)->toBe('csv,data');
});

it('can get bio link stats', function () {
    Http::fake([
        '*/bio/links/123/stats' => Http::response(['data' => []], 200),
    ]);
    $response = UrlHive::bio()->linkStats('123');
    expect($response)->toBeArray();
});

it('can reorder link list items', function () {
    Http::fake([
        '*/link-lists/123/items/reorder' => Http::response(['success' => true], 200),
    ]);
    $response = UrlHive::linkList()->reorderItems('123', ['1', '2']);
    expect($response['success'])->toBeTrue();
});

it('can get link list stats', function () {
    Http::fake([
        '*/link-lists/123/stats' => Http::response(['data' => []], 200),
    ]);
    $response = UrlHive::linkList()->stats('123');
    expect($response)->toBeArray();
});

it('can export link list analytics', function () {
    Http::fake([
        '*/link-lists/123/export' => Http::response('csv,data', 200),
    ]);
    $response = UrlHive::linkList()->export('123');
    expect($response)->toBe('csv,data');
});

it('can get link list item stats', function () {
    Http::fake([
        '*/link-lists/items/456/stats' => Http::response(['data' => []], 200),
    ]);
    $response = UrlHive::linkList()->itemStats('456');
    expect($response)->toBeArray();
});

it('can delete workspace', function () {
    Http::fake([
        '*/workspaces/123' => Http::response([], 200),
    ]);
    $response = UrlHive::workspace()->delete('123');
    expect($response)->toBeTrue();
});

it('can list workspace members', function () {
    Http::fake([
        '*/workspaces/123/members' => Http::response(['data' => []], 200),
    ]);
    $response = UrlHive::workspace()->members('123');
    expect($response)->toBeArray();
});

it('can invite workspace member', function () {
    Http::fake([
        '*/workspaces/123/invitations' => Http::response(['success' => true], 200),
    ]);
    $response = UrlHive::workspace()->invite('123', ['email' => 'test@example.com']);
    expect($response['success'])->toBeTrue();
});

it('can cancel workspace invitation', function () {
    Http::fake([
        '*/workspaces/invitations/inv123' => Http::response([], 200),
    ]);
    $response = UrlHive::workspace()->cancelInvitation('inv123');
    expect($response)->toBeTrue();
});

it('can remove workspace member', function () {
    Http::fake([
        '*/workspaces/123/members/user456' => Http::response([], 200),
    ]);
    $response = UrlHive::workspace()->removeMember('123', 'user456');
    expect($response)->toBeTrue();
});

it('can list workspace roles', function () {
    Http::fake([
        '*/workspaces/123/roles' => Http::response(['data' => []], 200),
    ]);
    $response = UrlHive::workspace()->roles('123');
    expect($response)->toBeArray();
});

it('can create workspace role', function () {
    Http::fake([
        '*/workspaces/123/roles' => Http::response(['success' => true], 200),
    ]);
    $response = UrlHive::workspace()->createRole('123', ['name' => 'Editor']);
    expect($response['success'])->toBeTrue();
});

it('can update workspace role', function () {
    Http::fake([
        '*/workspaces/123/roles/role789' => Http::response(['success' => true], 200),
    ]);
    $response = UrlHive::workspace()->updateRole('123', 'role789', ['name' => 'Admin']);
    expect($response['success'])->toBeTrue();
});

it('can delete workspace role', function () {
    Http::fake([
        '*/workspaces/123/roles/role789' => Http::response([], 200),
    ]);
    $response = UrlHive::workspace()->deleteRole('123', 'role789');
    expect($response)->toBeTrue();
});
