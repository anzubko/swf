<?php
declare(strict_types=1);

namespace App\Shared;

use SWF\FileLocker;

/**
 * @mixin FileLocker
 */
class Locker
{
    public static function getInstance(): FileLocker
    {
        return i(FileLocker::class);
    }
}
