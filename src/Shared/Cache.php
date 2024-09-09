<?php declare(strict_types=1);

namespace App\Shared;

use App\Config\CacheConfig;
use SWF\Interface\CacherInterface;

/**
 * @mixin CacherInterface
 */
class Cache
{
    public static function getInstance(): CacherInterface
    {
        return i(i(CacheConfig::class)->default);
    }
}
