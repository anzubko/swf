<?php declare(strict_types=1);

namespace App\Shared\Cache;

use SWF\AbstractShared;
use SWF\Interface\CacherInterface;
use SWF\MemCacher;

/**
 * @mixin CacherInterface
 */
class Memcached extends AbstractShared
{
    protected static function getInstance(): CacherInterface
    {
        return new MemCacher(...config('cache')->get('memcached'));
    }
}
