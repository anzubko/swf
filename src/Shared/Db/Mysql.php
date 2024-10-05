<?php declare(strict_types=1);

namespace App\Shared\Db;

use App\Config\DbConfig;
use App\Event\DbSlowQueryEvent;
use App\Shared\Dispatcher;
use App\Shared\Serializer;
use SWF\MysqlDatabaser;

/**
 * @mixin MysqlDatabaser
 */
class Mysql
{
    public static function getInstance(): MysqlDatabaser
    {
        return (new MysqlDatabaser(...i(DbConfig::class)->mysql))
            ->setDenormalizer(function (mixed $data, string $class): object {
                return i(Serializer::class)->denormalize($data, $class);
            })
            ->setProfiler(function (float $timer, array $queries): void {
                if ($timer >= i(DbConfig::class)->slowQueryMin) {
                    i(Dispatcher::class)->dispatch(new DbSlowQueryEvent($timer, $queries));
                }
            })
        ;
    }
}
