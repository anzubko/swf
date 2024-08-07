<?php

return [
    'APP_ENV' => 'dev',
    'APP_DEBUG' => false,
    'APP_STRICT' => true,
    'APP_URL' => null,
    'APP_ROBOTS' => false,

    'APP_MYSQL_HOST' => null,
    'APP_MYSQL_PORT' => null,
    'APP_MYSQL_DB' => null,
    'APP_MYSQL_USER' => null,
    'APP_MYSQL_PASS' => null,

    'APP_PGSQL_HOST' => null,
    'APP_PGSQL_PORT' => null,
    'APP_PGSQL_DB' => null,
    'APP_PGSQL_USER' => null,
    'APP_PGSQL_PASS' => null,

    'APP_DEFAULT_CACHE' => App\Shared\Cache\Nocache::class,

    'APP_MAILER_ENABLED' => true,
    'APP_MAILER_SENDER' => 'sender@domain.com',
    'APP_MAILER_RECIPIENTS' => null,
    'APP_MAILER_REPLIES' => null,
];
