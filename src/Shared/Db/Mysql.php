<?php declare(strict_types=1);

namespace App\Shared\Db;

use App\Event\DbSlowQueryEvent;
use App\Shared\Dispatcher;
use SWF\MysqlDatabaser;

/**
 * @mixin MysqlDatabaser
 */
class Mysql
{
    public static function getInstance(): MysqlDatabaser
    {
        $db = new MysqlDatabaser(...config('db')->get('mysql'));

        $db->setProfiler(
            function (float $timer, array $queries): void {
                if ($timer > config('db')->get('slowQueryMin')) {
                    instance(Dispatcher::class)->dispatch(new DbSlowQueryEvent($timer, $queries));
                }
            },
        );

        return $db;
    }
}
