<?php declare(strict_types=1);

namespace App\Shared\Db;

use App\Event\DbSlowQueryEvent;
use App\Shared\Config;
use App\Shared\Dispatcher;
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
        $db = new PgsqlDatabaser(...$this->s(Config::class)->get('db', 'pgsql'));

        $db->setProfiler(
            function (float $timer, array $queries): void {
                if ($timer > $this->s(Config::class)->get('db', 'slowQueryMin')) {
                    $this->s(Dispatcher::class)->dispatch(new DbSlowQueryEvent($timer, $queries));
                }
            }
        );

        return $db;
    }
}
