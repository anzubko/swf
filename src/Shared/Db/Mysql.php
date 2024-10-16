<?php
declare(strict_types=1);

namespace App\Shared\Db;

use App\Config\DatabaseConfig;
use SWF\MysqlDatabaser;

/**
 * @mixin MysqlDatabaser
 */
class Mysql
{
    public static function getInstance(): MysqlDatabaser
    {
        return new MysqlDatabaser(...i(DatabaseConfig::class)->mysql);
    }
}
