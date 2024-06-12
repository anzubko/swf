<?php declare(strict_types=1);

namespace App\Shared;

use LogicException;
use RuntimeException;
use SWF\AbstractShared;
use SWF\ListenerProvider;

/**
 * @mixin ListenerProvider
 */
class Provider extends AbstractShared
{
    /**
     * @throws LogicException
     * @throws RuntimeException
     */
    protected static function getInstance(): ListenerProvider
    {
        return ListenerProvider::getInstance();
    }
}
