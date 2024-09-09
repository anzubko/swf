<?php declare(strict_types=1);

namespace App\Shared;

use App\Config\DbConfig;
use SWF\Interface\DatabaserInterface;

/**
 * @mixin DatabaserInterface
 */
class Db
{
    public static function getInstance(): DatabaserInterface
    {
        return i(i(DbConfig::class)->default);
    }
}
