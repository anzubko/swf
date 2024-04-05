<?php declare(strict_types=1);

namespace App\Shared\Db;

use App\Event\DbSlowQueryEvent;
use App\Shared\Config;
use App\Shared\Dispatcher;
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

        $db->setProfiler(
            function (float $timer, array $queries): void {
                if ($timer > $this->s(Config::class)->dbSlowQueryMin) {
                    $this->s(Dispatcher::class)->dispatch(new DbSlowQueryEvent($timer, $queries));
                }
            }
        );

        return $db;
    }
}
