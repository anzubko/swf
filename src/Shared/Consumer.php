<?php
declare(strict_types=1);

namespace App\Shared;

use SWF\EventConsumer;

/**
 * @mixin EventConsumer
 */
class Consumer
{
    public static function getInstance(): EventConsumer
    {
        return i(EventConsumer::class);
    }
}
