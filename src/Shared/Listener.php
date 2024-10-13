<?php
declare(strict_types=1);

namespace App\Shared;

use SWF\ListenerProvider;

/**
 * @mixin ListenerProvider
 */
class Listener
{
    public static function getInstance(): ListenerProvider
    {
        return i(ListenerProvider::class);
    }
}
