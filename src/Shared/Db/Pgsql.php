<?php declare(strict_types=1);

namespace App\Shared\Db;

use App\Shared\Config;
use App\Shared\Logger;
use SWF\AbstractShared;
use SWF\Interface\DatabaserInterface;
use SWF\PgsqlDatabaser;

/**
 * @mixin DatabaserInterface
 */
class Pgsql extends AbstractShared
{
    protected function getInstance(): DatabaserInterface
    {
        $db = new PgsqlDatabaser(...$this->s(Config::class)->dbPgsql);

        $db->setProfiler($this->s(Logger::class)->dbSlowQuery(...));

        return $db;
    }
}
