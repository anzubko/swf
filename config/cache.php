<?php

use App\Shared\Cache\Apc;
use App\Shared\Cache\Memcached;
use App\Shared\Cache\Redis;

return [
    /**
     * Default cache.
     *
     * string
     */
    'default' => env('APP_DEFAULT_CACHE', Apc::class),

    /**
     * Apc settings.
     *
     * mixed[] {@see Apc}
     */
    'apc' => ['ns' => null, 'ttl' => 3600],

    /**
     * Memcached settings.
     *
     * mixed[] {@see Memcached}
     */
    'memcached' => ['ns' => null, 'ttl' => 3600, 'servers' => [['127.0.0.1', 11211]]],

    /**
     * Redis settings.
     *
     * mixed[] {@see Redis}
     */
    'redis' => ['ns' => null, 'ttl' => 3600, 'connect' => ['127.0.0.1', 6379, 2.5]],
];
