<?php declare(strict_types=1);

namespace App\Shared;

use SWF\AbstractShared;
use SWF\Interface\CacherInterface;

/**
 * @mixin CacherInterface
 */
class Cache extends AbstractShared
{
    protected static function getInstance(): CacherInterface
    {
        return shared(config('cache')->get('default'));
    }
}
