# URLHive Laravel SDK

This is the official Laravel SDK for the [URLHive](https://urlhive.net) API.

## Installation

You can install the package via composer:

```bash
composer require urlhive/urlhive-laravel
```

## Configuration

Publish the config file:

```bash
php artisan vendor:publish --tag=urlhive-config
```

Add your API credentials to `.env`:

```env
URLHIVE_API_URL=https://api.urlhive.net
URLHIVE_API_TOKEN=your-api-token
```

## Usage

### URLs

```php
use UrlHive\Laravel\Facades\UrlHive;

// List URLs
$urls = UrlHive::url()->list(['page' => 1]);

// Shorten a URL
// custom_alias: 3-20 characters, alpha-numeric/dash
$response = UrlHive::url()->shorten('https://example.com', [
    'custom_alias' => 'my-link',
    'expires_at' => '2026-12-31'
]);

// Get URL Details
$details = UrlHive::url()->get('my-link');

// Update URL
UrlHive::url()->update('my-link', ['destination' => 'https://new-url.com']);

// Toggle URL Status
// Enables or disables the short link
UrlHive::url()->toggle('my-link');

// Export URL Stats (CSV)
// Returns a CSV string containing detailed click data
$csv = UrlHive::url()->export('my-link');

// Delete URL
UrlHive::url()->delete('my-link');
```

### Analytics

```php
// Get URL Stats
// Includes: Timeline, Countries, Cities, Devices, Browsers, Referrers
$stats = UrlHive::analytics()->stats('my-link');
```

### Bio Pages

Manage your "Link in Bio" page.

```php
// Get Bio Page
$bio = UrlHive::bio()->show();

// Create/Update Bio Page
// Themes: 'minimal', 'dark', 'colorful'
UrlHive::bio()->store([
    'username' => 'john.doe',
    'title' => 'John Doe',
    'bio' => 'Software Engineer',
    'theme' => 'dark'
]);

// Add Link to Bio
$link = UrlHive::bio()->addLink([
    'title' => 'My Portfolio',
    'url' => 'https://john.doe/portfolio',
    'icon' => 'briefcase' // Optional icon identifier
]);

// Update Bio Link
UrlHive::bio()->updateLink($link['id'], ['title' => 'New Portfolio Title']);

// Reorder Links
UrlHive::bio()->reorderLinks(['id1', 'id3', 'id2']);

// Delete Bio Link
UrlHive::bio()->deleteLink($link['id']);
```

### Link Lists

Create and manage collections of links. Public lists can be viewed by anyone.

```php
// List Link Lists
$lists = UrlHive::linkLists()->list();

// Create Link List
$list = UrlHive::linkLists()->create([
    'name' => 'My Tech Stack',
    'is_public' => true
]);

// Get Link List
$details = UrlHive::linkLists()->get($list['id']);

// Update Link List
UrlHive::linkLists()->update($list['id'], ['name' => 'Updated Name']);

// Delete Link List
UrlHive::linkLists()->delete($list['id']);

// Add Item
$item = UrlHive::linkLists()->addItem($list['id'], [
    'title' => 'Laravel',
    'url' => 'https://laravel.com',
    'description' => 'The PHP Framework for Web Artisans'
]);

// Update Item
UrlHive::linkLists()->updateItem($item['id'], ['title' => 'Laravel Framework']);

// Track Item Click
UrlHive::linkLists()->trackItemClick($item['id']);

// Delete Item
UrlHive::linkLists()->deleteItem($item['id']);
```

### Workspaces

> **Note:** The Workspaces API is only available for accounts on the **Enterprise** plan.

```php
// List Workspaces
$workspaces = UrlHive::workspaces()->list();

// Create Workspace
$workspace = UrlHive::workspaces()->create(['name' => 'My Team']);

// Update Workspace
UrlHive::workspaces()->update($workspace['id'], ['name' => 'My New Team Name']);

// Switch Workspace
// Changes the active workspace for subsequent API requests
UrlHive::workspaces()->switch($workspace['id']);
```

### Pixels

Manage tracking pixels for retargeting (Facebook, Google Analytics, etc.).

```php
// List Pixels
$pixels = UrlHive::pixels()->list();

// Create Pixel
// Types: 'facebook', 'google-analytics', 'custom'
$pixel = UrlHive::pixels()->create([
    'name' => 'Facebook Ads',
    'type' => 'facebook',
    'pixel_id' => '1234567890'
]);

// Get Pixel
$details = UrlHive::pixels()->get($pixel['id']);

// Update Pixel
UrlHive::pixels()->update($pixel['id'], ['name' => 'Updated Pixel Name']);

// Delete Pixel
UrlHive::pixels()->delete($pixel['id']);
```

## Testing

```bash
composer test
```

## License

The MIT License (MIT).
