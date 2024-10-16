<?php
declare(strict_types=1);

namespace App\Config;

use SWF\AbstractConfig;
use SWF\Attribute\Env;

class MessageConfig extends AbstractConfig
{
    /**
     * RabbitMQ settings.
     *
     * @var mixed[]
     */
    #[Env('APP_RABBIT_MQ')]
    public array $rabbitMQ = [
        'host' => 'localhost',
        'port' => 5672,
        'user' => 'quest',
        'pass' => 'guest',
    ];
}
