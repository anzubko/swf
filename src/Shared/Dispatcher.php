<?php declare(strict_types=1);

namespace App\Shared;

use SWF\AbstractShared;
use SWF\EventDispatcher;

/**
 * @mixin EventDispatcher
 */
class Dispatcher extends AbstractShared
{
    protected static function getInstance(): EventDispatcher
    {
        return EventDispatcher::getInstance();
    }
}
