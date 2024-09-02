<?php declare(strict_types=1);

namespace App\Shared\Cache;

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
        return new RedisCacher(...config('cache')->get('redis'));
    }
}
