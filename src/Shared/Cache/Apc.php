<?php
declare(strict_types=1);

namespace App\Shared\Cache;

use App\Config\CacheConfig;
use SWF\ApcCacher;

/**
 * @mixin ApcCacher
 */
class Apc
{
    public static function getInstance(): ApcCacher
    {
        return new ApcCacher(...i(CacheConfig::class)->apc);
    }
}
