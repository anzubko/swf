<?php declare(strict_types=1);

namespace App\Config;

use App\Shared\Db\Mysql;
use App\Shared\Db\Pgsql;
use SWF\AbstractConfig;
use SWF\Attribute\Env;

class DbConfig extends AbstractConfig
{
    /**
     * Default database.
     *
     * @var class-string
     */
    public string $default = Mysql::class;

    /**
     * Log slow queries.
     */
    public ?string $slowQueryLog = APP_DIR . '/var/log/slow.queries.log';

    /**
     * Log slow queries with minimal time in seconds.
     */
    public float $slowQueryMin = 0.5;

    /**
     * Mysql settings.
     *
     * @see Mysql
     *
     * @var mixed[]
     */
    #[Env('APP_MYSQL')] public array $mysql = [
        'host' => null,
        'port' => null,
        'db' => null,
        'user' => null,
        'pass' => null,
    ];

    /**
     * Pgsql settings.
     *
     * @see Pgsql
     *
     * @var mixed[]
     */
    #[Env('APP_PGSQL')] public array $pgsql = [
        'host' => null,
        'port' => null,
        'db' => null,
        'user' => null,
        'pass' => null,
    ];
}
