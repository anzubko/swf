<?php declare(strict_types=1);

namespace App\Shared;

use SWF\AbstractShared;
use SWF\EventDispatcher;
use SWF\InstanceHolder;

/**
 * @mixin EventDispatcher
 */
class Dispatcher extends AbstractShared
{
    protected function getInstance(): EventDispatcher
    {
        return InstanceHolder::get(EventDispatcher::class);
    }
}
