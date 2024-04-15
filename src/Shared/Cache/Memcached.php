<?php declare(strict_types=1);

namespace App\Shared\Cache;

use App\Shared\Config;
use SWF\AbstractShared;
use SWF\Interface\CacherInterface;
use SWF\MemCacher;

/**
 * @mixin CacherInterface
 */
class Memcached extends AbstractShared
{
    protected function getInstance(): CacherInterface
    {
        return new MemCacher(...$this->s(Config::class)->get('cache', 'memcached'));
    }
}
