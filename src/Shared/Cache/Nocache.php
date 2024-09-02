<?php declare(strict_types=1);

namespace App\Shared\Cache;

use SWF\NoCacher;

/**
 * @mixin NoCacher
 */
class Nocache
{
    public static function getInstance(): NoCacher
    {
        return new NoCacher();
    }
}
