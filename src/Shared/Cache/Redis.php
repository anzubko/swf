<?php
declare(strict_types=1);

namespace App\Shared\Cache;

use App\Config\CacheConfig;
use SWF\Exception\CacherException;
use SWF\RedisCacher;

/**
 * @mixin RedisCacher
 */
class Redis
{
    /**
     * @throws CacherException
     */
    public static function getInstance(): RedisCacher
    {
        return new RedisCacher(...i(CacheConfig::class)->redis);
    }
}
