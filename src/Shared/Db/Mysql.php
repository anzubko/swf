<?php
declare(strict_types=1);

namespace App\Shared\Db;

use App\Config\DatabaseConfig;
use SWF\Exception\DatabaserException;
use SWF\MysqlDatabaser;

/**
 * @mixin MysqlDatabaser
 */
class Mysql
{
    /**
     * @throws DatabaserException
     */
    public static function getInstance(): MysqlDatabaser
    {
        return new MysqlDatabaser(...i(DatabaseConfig::class)->mysql);
    }
}
