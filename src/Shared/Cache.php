<?php declare(strict_types=1);

namespace App\Shared;

use SWF\Interface\CacherInterface;

/**
 * @mixin CacherInterface
 */
class Cache
{
    public static function getInstance(): CacherInterface
    {
        return i(config('cache')->get('default'));
    }
}
