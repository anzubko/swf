<?php declare(strict_types=1);

namespace App\Shared;

use SWF\AbstractShared;
use SWF\FileLocker;

/**
 * @mixin FileLocker
 */
class Locker extends AbstractShared
{
    protected static function getInstance(): FileLocker
    {
        return FileLocker::getInstance();
    }
}
