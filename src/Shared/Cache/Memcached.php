<?php declare(strict_types=1);

namespace App\Shared\Cache;

use App\Config\CacheConfig;
use SWF\MemCacher;

/**
 * @mixin MemCacher
 */
class Memcached
{
    public static function getInstance(): MemCacher
    {
        return new MemCacher(...i(CacheConfig::class)->memcached);
    }
}
