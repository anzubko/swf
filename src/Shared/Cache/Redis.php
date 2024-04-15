<?php declare(strict_types=1);

namespace App\Shared\Cache;

use App\Shared\Config;
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
    protected function getInstance(): CacherInterface
    {
        return  new RedisCacher(...$this->s(Config::class)->get('cache', 'redis'));
    }
}
