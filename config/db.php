<?php

return [
    /**
     * Default database.
     *
     * string
     */
    'default' => App\Shared\Db\Mysql::class,

    /**
     * Mysql settings.
     *
     * mixed[] {@see App\Shared\Db\Mysql}
     */
    'mysql' => [
        'host' => env('APP_MYSQL_HOST', 'localhost'),
        'port' => env('APP_MYSQL_PORT', 3306),
        'db' => env('APP_MYSQL_DB'),
        'user' => env('APP_MYSQL_USER'),
        'pass' => env('APP_MYSQL_PASS'),
    ],

    /**
     * Pgsql settings.
     *
     * mixed[] {@see App\Shared\Db\Pgsql}
     */
    'pgsql' => [
        'host' => env('APP_PGSQL_HOST', 'localhost'),
        'port' => env('APP_PGSQL_PORT', 5432),
        'db' => env('APP_PGSQL_DB'),
        'user' => env('APP_PGSQL_USER'),
        'pass' => env('APP_PGSQL_PASS'),
    ],

    /**
     * Log slow queries.
     *
     * string|null
     */
    'slowQueryLog' => APP_DIR . '/var/log/slow.queries.log',

    /**
     * Log slow queries with minimal time in seconds.
     *
     * float
     */
    'slowQueryMin' => 0.5,
];
