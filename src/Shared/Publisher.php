<?php
declare(strict_types=1);

namespace App\Shared;

use SWF\DelayedPublisher;

/**
 * @mixin DelayedPublisher
 */
class Publisher
{
    public static function getInstance(): DelayedPublisher
    {
        return i(DelayedPublisher::class);
    }
}
