<?php declare(strict_types=1);

namespace App\Shared\Cache;

use SWF\AbstractShared;
use SWF\Exception\CacherException;
use SWF\Interface\CacherInterface;
use SWF\RedisCacher;

/**
 * @mixin CacherInterface
 */
class Redis extends AbstractShared
{
    /**
     * @throws CacherException
     */
    protected static function getInstance(): CacherInterface
    {
        return  new RedisCacher(...config('cache')->get('redis'));
    }
}
