<?php

return [
    /**
     * Default database.
     *
     * string
     */
    'default' => App\Shared\Db\Mysql::class,

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

    /**
     * Mysql settings.
     *
     * mixed[] {@see App\Shared\Db\Mysql}
     */
    'mysql' => [
        'host' => env('APP_MYSQL_HOST'),
        'port' => env('APP_MYSQL_PORT'),
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
        'host' => env('APP_PGSQL_HOST'),
        'port' => env('APP_PGSQL_PORT'),
        'db' => env('APP_PGSQL_DB'),
        'user' => env('APP_PGSQL_USER'),
        'pass' => env('APP_PGSQL_PASS'),
    ],
];
