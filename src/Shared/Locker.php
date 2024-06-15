<?php declare(strict_types=1);

namespace App\Shared;

use SWF\AbstractShared;
use SWF\LocalLocker;

/**
 * @mixin LocalLocker
 */
class Locker extends AbstractShared
{
    protected static function getInstance(): LocalLocker
    {
        return LocalLocker::getInstance();
    }
}
