<?php
declare(strict_types=1);

namespace App\Config;

use App\Shared\Db\Mysql;
use SWF\AbstractConfig;
use SWF\Attribute\GetEnv;

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
    #[GetEnv('APP_SLOW_QUERY_MIN')]
    public float $slowQueryMin = 0.5;

    /**
     * Mysql settings.
     *
     * @var mixed[]
     */
    #[GetEnv('APP_MYSQL')]
    public array $mysql = [
        'name' => 'Mysql',
        'host' => null,
        'port' => null,
        'db' => null,
        'user' => null,
        'pass' => null,
    ];

    /**
     * Pgsql settings.
     *
     * @var mixed[]
     */
    #[GetEnv('APP_PGSQL')]
    public array $pgsql = [
        'name' => 'Pgsql',
        'host' => null,
        'port' => null,
        'db' => null,
        'user' => null,
        'pass' => null,
    ];
}
