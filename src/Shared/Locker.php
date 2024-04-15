<?php declare(strict_types=1);

namespace App\Shared;

use SWF\AbstractShared;
use SWF\InstanceHolder;
use SWF\ProcessLocker;

/**
 * @mixin ProcessLocker
 */
class Locker extends AbstractShared
{
    protected function getInstance(): ProcessLocker
    {
        return InstanceHolder::get(ProcessLocker::class);
    }
}
