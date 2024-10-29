<?php
declare(strict_types=1);

namespace App\Config;

use App\Shared\Cache\Apc;
use App\Shared\Cache\Memcached;
use App\Shared\Cache\Nocache;
use App\Shared\Cache\Redis;
use SWF\AbstractConfig;
use SWF\Attribute\GetEnv;

class CacheConfig extends AbstractConfig
{
    /**
     * Default cache.
     *
     * @var class-string
     */
    #[GetEnv('APP_DEFAULT_CACHE')]
    public string $default = Nocache::class;

    /**
     * Apc settings.
     *
     * @see Apc
     *
     * @var mixed[]
     */
    public array $apc = [
        'ns' => null,
        'ttl' => 3600,
    ];

    /**
     * Memcached settings.
     *
     * @see Memcached
     *
     * @var mixed[]
     */
    #[GetEnv('APP_MEMCACHED')]
    public array $memcached = [
        'ns' => null,
        'ttl' => 3600,
        'servers' => [['127.0.0.1', 11211]],
    ];

    /**
     * Redis settings.
     *
     * @see Redis
     *
     * @var mixed[]
     */
    #[GetEnv('APP_REDIS')]
    public array $redis = [
        'ns' => null,
        'ttl' => 3600,
        'connect' => ['127.0.0.1', 6379, 2.5],
    ];
}
