<?php declare(strict_types=1);

namespace App\Shared;

use SWF\AbstractShared;
use SWF\InstanceHolder;
use SWF\ListenerProvider;

/**
 * @mixin ListenerProvider
 */
class Provider extends AbstractShared
{
    protected function getInstance(): ListenerProvider
    {
        return InstanceHolder::get(ListenerProvider::class);
    }
}
