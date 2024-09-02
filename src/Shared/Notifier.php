<?php declare(strict_types=1);

namespace App\Shared;

use SWF\DelayedNotifier;

/**
 * @mixin DelayedNotifier
 */
class Notifier
{
    public static function getInstance(): DelayedNotifier
    {
        return new DelayedNotifier();
    }
}
