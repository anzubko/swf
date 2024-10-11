<?php declare(strict_types=1);

namespace App\Shared\Db;

use App\Config\DbConfig;
use SWF\PgsqlDatabaser;

/**
 * @mixin PgsqlDatabaser
 */
class Pgsql
{
    public static function getInstance(): PgsqlDatabaser
    {
        return new PgsqlDatabaser(...i(DbConfig::class)->pgsql);
    }
}
