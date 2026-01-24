<?php

namespace UrlHive\Laravel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \UrlHive\Laravel\Resources\UrlResource url()
 * @method static \UrlHive\Laravel\Resources\BioResource bio()
 * @method static \UrlHive\Laravel\Resources\AnalyticsResource analytics()
 *
 * @see \UrlHive\Laravel\UrlHiveClient
 */
class UrlHive extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'urlhive';
    }
}
