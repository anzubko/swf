<?php declare(strict_types=1);

namespace App\Shared\Db;

use App\Event\DbSlowQueryEvent;
use App\Shared\Dispatcher;
use SWF\AbstractShared;
use SWF\PgsqlDatabaser;

/**
 * @mixin PgsqlDatabaser
 */
class Pgsql extends AbstractShared
{
    protected static function getInstance(): PgsqlDatabaser
    {
        $db = new PgsqlDatabaser(...config('db')->get('pgsql'));

        $db->setProfiler(
            function (float $timer, array $queries): void {
                if ($timer > config('db')->get('slowQueryMin')) {
                    shared(Dispatcher::class)->dispatch(new DbSlowQueryEvent($timer, $queries));
                }
            }
        );

        return $db;
    }
}
