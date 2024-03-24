<?php declare(strict_types=1);

namespace App\Shared\Db;

use App\Shared\Config;
use App\Shared\Logger;
use SWF\AbstractShared;
use SWF\Interface\DatabaserInterface;
use SWF\MysqlDatabaser;

/**
 * @mixin DatabaserInterface
 */
class Mysql extends AbstractShared
{
    protected function getInstance(): DatabaserInterface
    {
        $db = new MysqlDatabaser(...$this->s(Config::class)->dbMysql);

        $db->setProfiler($this->s(Logger::class)->dbSlowQuery(...));

        return $db;
    }
}
