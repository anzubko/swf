<?php

return [
    'APP_ENV' => 'dev',
    'APP_DEBUG' => false,
    'APP_STRICT' => true,
    'APP_URL' => null,
    'APP_ROBOTS' => false,

    'APP_MYSQL_HOST' => 'localhost',
    'APP_MYSQL_PORT' => 3306,
    'APP_MYSQL_DB' => null,
    'APP_MYSQL_USER' => null,
    'APP_MYSQL_PASS' => null,

    'APP_PGSQL_HOST' => 'localhost',
    'APP_PGSQL_PORT' => 5432,
    'APP_PGSQL_DB' => null,
    'APP_PGSQL_USER' => null,
    'APP_PGSQL_PASS' => null,

    'APP_DEFAULT_CACHE' => App\Shared\Cache\Apc::class,

    'APP_MAILER_ENABLED' => true,
    'APP_MAILER_SENDER' => 'sender@domain.com',
    'APP_MAILER_RECIPIENTS' => null,
    'APP_MAILER_REPLIES' => null,
];
