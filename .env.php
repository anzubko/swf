<?php

return [
    'APP_ENV' => 'dev',
    'APP_DEBUG' => false,
    'APP_URL' => null,
    'APP_ROBOTS' => false,

    'APP_DEFAULT_CACHE' => App\Shared\Cache\Nocache::class,

    'APP_MYSQL' => [
        'host' => null,
        'port' => null,
        'db' => null,
        'user' => null,
        'pass' => null,
    ],
    'APP_PGSQL' => [
        'host' => null,
        'port' => null,
        'db' => null,
        'user' => null,
        'pass' => null,
    ],
    'APP_MAILER' => [
        'enabled' => true,
        'sender' => 'sender@domain.com',
        'recipients' => null,
        'replies' => null,
    ],
];
