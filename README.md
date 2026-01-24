# URLHive Laravel SDK

This is the official Laravel SDK for the URLHive API.

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
URLHIVE_API_URL=https://urlhive.com/api/v1
URLHIVE_API_TOKEN=your-api-token
```

## Usage

```php
use UrlHive\Laravel\Facades\UrlHive;

// Shorten a URL
$response = UrlHive::url()->shorten('https://example.com');
echo $response['short_url'];

// Get URL Stats
$stats = UrlHive::analytics()->stats('my-short-code');
```

## Testing

```bash
composer test
```

## License

The MIT License (MIT).
