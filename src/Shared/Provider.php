<?php
declare(strict_types=1);

namespace App\Shared;

use LogicException;
use RuntimeException;
use SWF\ListenerProvider;

/**
 * @mixin ListenerProvider
 */
class Provider
{
    /**
     * @throws LogicException
     * @throws RuntimeException
     */
    public static function getInstance(): ListenerProvider
    {
        return i(ListenerProvider::class);
    }
}
