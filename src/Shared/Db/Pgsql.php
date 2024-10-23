<?php
declare(strict_types=1);

namespace App\Shared\Db;

use App\Config\DatabaseConfig;
use SWF\Exception\DatabaserException;
use SWF\PgsqlDatabaser;

/**
 * @mixin PgsqlDatabaser
 */
class Pgsql
{
    /**
     * @throws DatabaserException
     */
    public static function getInstance(): PgsqlDatabaser
    {
        return new PgsqlDatabaser(...i(DatabaseConfig::class)->pgsql);
    }
}
