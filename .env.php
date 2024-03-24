<?php

return [
    'APP_ENV' => 'dev',
    'APP_DEBUG' => false,
    'APP_URL' => null,
    'APP_ROBOTS' => false,

    'APP_DB_MYSQL' => [
        'host' => 'localhost',
        'port' => 3306,
        'db' => null,
        'user' => null,
        'pass' => null,
        'persistent' => false,
    ],

    'APP_DB_PGSQL' => [
        'host' => 'localhost',
        'port' => 5432,
        'db' => null,
        'user' => null,
        'pass' => null,
        'persistent' => false,
    ],

    'APP_DEFAULT_CACHE' => App\Shared\Cache\Apc::class,

    'APP_MAILER' => [
        'enabled' => true,
        'sender' => 'sender@domain.com',
        'recipients' => null,
        'replies' => null,
    ],

    ...$_SERVER,
];
