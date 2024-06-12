<?php declare(strict_types=1);

namespace App\Shared;

use RuntimeException;
use SWF\AbstractShared;
use SWF\LocalLocker;

/**
 * @mixin LocalLocker
 */
class Locker extends AbstractShared
{
    /**
     * @throws RuntimeException
     */
    protected static function getInstance(): LocalLocker
    {
        return LocalLocker::getInstance();
    }
}
