<?php
declare(strict_types=1);

namespace App\Config;

use SWF\AbstractSystemConfig;
use SWF\Attribute\GetEnv;

/**
 * Please, do not add you own custom properties to this class!
 */
class SystemConfig extends AbstractSystemConfig
{
    /**
     * Environment mode ('dev', 'test', 'prod', etc..).
     */
    #[GetEnv('APP_ENV')]
    public string $env = 'dev';

    /**
     * Debug mode (not minify HTML/CSS/JS if true).
     */
    #[GetEnv('APP_DEBUG')]
    public bool $debug = false;

    /**
     * Basic url (autodetect if null).
     */
    #[GetEnv('APP_URL')]
    public ?string $url = null;

    /**
     * Default timezone.
     */
    public string $timezone = 'UTC';

    /**
     * In strict mode all warnings are replaced by exceptions.
     */
    public bool $strict = false;

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
     * Directory for cache.
     */
    public string $cacheDir = APP_DIR . '/var/cache';

    /**
     * Directory for file based locks.
     */
    public string $locksDir = APP_DIR . '/var/locks';

    /**
     * Custom log file.
     */
    public ?string $customLog = APP_DIR . '/var/log/{ENV}.log';
}
