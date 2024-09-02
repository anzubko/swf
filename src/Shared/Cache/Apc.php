<?php declare(strict_types=1);

namespace App\Shared\Cache;

use SWF\ApcCacher;

/**
 * @mixin ApcCacher
 */
class Apc
{
    public static function getInstance(): ApcCacher
    {
        return new ApcCacher(...config('cache')->get('apc'));
    }
}
