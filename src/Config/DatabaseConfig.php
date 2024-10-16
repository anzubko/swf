<?php
declare(strict_types=1);

namespace App\Config;

use App\Shared\Db\Mysql;
use App\Shared\Db\Pgsql;
use SWF\AbstractConfig;
use SWF\Attribute\Env;

class DatabaseConfig extends AbstractConfig
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
    #[Env('APP_SLOW_QUERY_MIN')]
    public float $slowQueryMin = 0.5;

    /**
     * Mysql settings.
     *
     * @see Mysql
     *
     * @var mixed[]
     */
    #[Env('APP_MYSQL')]
    public array $mysql = [
        'name' => 'Mysql',
    ];

    /**
     * Pgsql settings.
     *
     * @see Pgsql
     *
     * @var mixed[]
     */
    #[Env('APP_PGSQL')]
    public array $pgsql = [
        'name' => 'Pgsql',
    ];
}
