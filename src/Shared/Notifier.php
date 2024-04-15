<?php declare(strict_types=1);

namespace App\Shared;

use SWF\AbstractShared;
use SWF\DelayedNotifier;
use SWF\InstanceHolder;

/**
 * @mixin DelayedNotifier
 */
class Notifier extends AbstractShared
{
    protected function getInstance(): DelayedNotifier
    {
        return InstanceHolder::get(DelayedNotifier::class);
    }
}
