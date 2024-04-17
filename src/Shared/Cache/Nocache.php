<?php declare(strict_types=1);

namespace App\Shared\Cache;

use SWF\AbstractShared;
use SWF\Interface\CacherInterface;
use SWF\NoCacher;

/**
 * @mixin CacherInterface
 */
class Nocache extends AbstractShared
{
    protected static function getInstance(): CacherInterface
    {
        return new NoCacher();
    }
}
