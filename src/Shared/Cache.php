<?php declare(strict_types=1);

namespace App\Shared;

use SWF\AbstractShared;
use SWF\Interface\CacherInterface;

/**
 * @mixin CacherInterface
 */
class Cache extends AbstractShared
{
    protected function getInstance(): CacherInterface
    {
        return $this->s($this->s(Config::class)->get('cache', 'default'));
    }
}
