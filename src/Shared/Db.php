<?php declare(strict_types=1);

namespace App\Shared;

use SWF\Interface\DatabaserInterface;

/**
 * @mixin DatabaserInterface
 */
class Db
{
    public static function getInstance(): DatabaserInterface
    {
        return i(config('db')->get('default'));
    }
}
