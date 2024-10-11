<?php
declare(strict_types=1);

namespace App\Shared;

use SWF\EventDispatcher;

/**
 * @mixin EventDispatcher
 */
class Dispatcher
{
    public static function getInstance(): EventDispatcher
    {
        return i(EventDispatcher::class);
    }
}
