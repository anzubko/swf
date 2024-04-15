<?php declare(strict_types=1);

namespace App\Shared\Cache;

use App\Shared\Config;
use SWF\AbstractShared;
use SWF\ApcCacher;
use SWF\Interface\CacherInterface;

/**
 * @mixin CacherInterface
 */
class Apc extends AbstractShared
{
    protected function getInstance(): CacherInterface
    {
        return new ApcCacher(...$this->s(Config::class)->get('cache', 'apc'));
    }
}
