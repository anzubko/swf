<?php declare(strict_types=1);

namespace App\Shared\Cache;

use SWF\AbstractShared;
use SWF\MemCacher;

/**
 * @mixin MemCacher
 */
class Memcached extends AbstractShared
{
    protected static function getInstance(): MemCacher
    {
        return new MemCacher(...config('cache')->get('memcached'));
    }
}
