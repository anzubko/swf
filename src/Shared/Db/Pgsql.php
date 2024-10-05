<?php declare(strict_types=1);

namespace App\Shared\Db;

use App\Config\DbConfig;
use App\Event\DbSlowQueryEvent;
use App\Shared\Dispatcher;
use App\Shared\Serializer;
use SWF\PgsqlDatabaser;

/**
 * @mixin PgsqlDatabaser
 */
class Pgsql
{
    public static function getInstance(): PgsqlDatabaser
    {
        return (new PgsqlDatabaser(...i(DbConfig::class)->pgsql))
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
