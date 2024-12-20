<?php
declare(strict_types=1);

namespace App\Config;

use SWF\AbstractConfig;
use SWF\Attribute\GetEnv;

class CommonConfig extends AbstractConfig
{
    /**
     * Allow robots.
     */
    #[GetEnv('APP_ROBOTS')]
    public bool $robots = false;

    /**
     * Application name.
     */
    public string $name = 'Simplest framework';

    /**
     * Optional error document file.
     */
    public ?string $errorDocument = APP_DIR . '/public/.bin/errors/{CODE}.html.php';

    /**
     * Mailer settings.
     *
     * @var mixed[]
     */
    #[GetEnv('APP_MAILER')]
    public array $mailer = [
        'enabled' => true,
        'strict' => false,
        'sender' => null,
        'recipients' => null,
        'replies' => null,
    ];

    /**
     * Assets merger settings.
     *
     * @var mixed[]
     */
    public array $merger = [
        'location' => '/.merged',
        'dir' => APP_DIR . '/var/cache/merged',
        'docRoot' => APP_DIR . '/public',
        'metricsFile' => APP_DIR . '/var/cache/merged.metrics.php',
        'assets' => [
            'all.css' => APP_DIR . '/assets/css/*.css',
            'all.js' => APP_DIR . '/assets/js/*.js',
        ],
    ];
}
