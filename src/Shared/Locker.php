<?php declare(strict_types=1);

namespace App\Shared;

use SWF\AbstractShared;
use SWF\ProcessLocker;

/**
 * @mixin ProcessLocker
 */
class Locker extends AbstractShared
{
    protected static function getInstance(): ProcessLocker
    {
        return ProcessLocker::getInstance();
    }
}
