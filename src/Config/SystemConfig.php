<?php declare(strict_types=1);

namespace App\Config;

use SWF\AbstractSystemConfig;
use SWF\Attribute\Env;

class SystemConfig extends AbstractSystemConfig
{
    /**
     * Environment mode ('dev', 'test', 'prod', etc..).
     */
    #[Env('APP_ENV')]
    public string $env = 'dev';

    /**
     * Debug mode (not minify HTML/CSS/JS if true).
     */
    #[Env('APP_DEBUG')]
    public bool $debug = false;

    /**
     * Basic url (autodetect if null).
     */
    #[Env('APP_URL')]
    public ?string $url = null;

    /**
     * Default timezone.
     */
    public string $timezone = 'UTC';

    /**
     * Default mode for created directories.
     */
    public int $dirMode = 0777;

    /**
     * Default mode for created/updated files.
     */
    public int $fileMode = 0666;

    /**
     * Namespaces prefixes where can be classes with controllers, commands, listeners or child classes for iterations.
     *
     * @var string[]
     */
    public array $allowedNsPrefixes = ['SWF\\', 'App\\'];

    /**
     * Custom log file.
     */
    public ?string $customLog = APP_DIR . '/var/log/{ENV}.log';
}
