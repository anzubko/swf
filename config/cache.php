<?php

return [
    /**
     * Default cache.
     *
     * string
     */
    'default' => env('APP_DEFAULT_CACHE', App\Shared\Cache\Nocache::class),

    /**
     * Apc settings.
     *
     * mixed[] {@see App\Shared\Cache\Apc}
     */
    'apc' => [
        'ns' => null,
        'ttl' => 3600,
    ],

    /**
     * Memcached settings.
     *
     * mixed[] {@see App\Shared\Cache\Memcached}
     */
    'memcached' => [
        'ns' => null,
        'ttl' => 3600,
        'servers' => [['127.0.0.1', 11211]],
    ],

    /**
     * Redis settings.
     *
     * mixed[] {@see App\Shared\Cache\Redis}
     */
    'redis' => [
        'ns' => null,
        'ttl' => 3600,
        'connect' => ['127.0.0.1', 6379, 2.5],
    ],
];
