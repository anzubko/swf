<?php
declare(strict_types=1);

namespace App\Shared;

use SWF\MessageDispatcher;

/**
 * @mixin MessageDispatcher
 */
class Message
{
    public static function getInstance(): MessageDispatcher
    {
        return i(MessageDispatcher::class);
    }
}
