<?php declare(strict_types=1);

namespace App\Shared\Cache;

use SWF\AbstractShared;
use SWF\ApcCacher;

/**
 * @mixin ApcCacher
 */
class Apc extends AbstractShared
{
    protected static function getInstance(): ApcCacher
    {
        return new ApcCacher(...config('cache')->get('apc'));
    }
}
