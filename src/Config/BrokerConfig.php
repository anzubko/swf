<?php
declare(strict_types=1);

namespace App\Config;

use SWF\AbstractConfig;
use SWF\Attribute\GetEnv;

class BrokerConfig extends AbstractConfig
{
    /**
     * RabbitMQ settings.
     *
     * @var mixed[]
     */
    #[GetEnv('APP_RABBIT_MQ')]
    public array $rabbitMQ = [
        'host' => 'localhost',
        'port' => 5672,
        'user' => 'quest',
        'pass' => 'guest',
    ];
}
