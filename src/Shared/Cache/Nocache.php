<?php declare(strict_types=1);

namespace App\Shared\Cache;

use SWF\AbstractShared;
use SWF\NoCacher;

/**
 * @mixin NoCacher
 */
class Nocache extends AbstractShared
{
    protected static function getInstance(): NoCacher
    {
        return new NoCacher();
    }
}
