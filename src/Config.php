<?php declare(strict_types=1);

namespace App;

use App\Shared\Cache\Apc;
use App\Shared\Cache\Memcached;
use App\Shared\Cache\Redis;
use App\Shared\Db\Mysql;
use App\Shared\Db\Pgsql;
use App\Shared\Mailer;
use App\Shared\Merger;
use App\Shared\Template\Native;
use App\Shared\Template\Twig;
use App\Shared\Template\Xslt;
use SWF\AbstractConfig;
use SWF\Attribute\Env;

class Config extends AbstractConfig
{
    /**
     * Environment mode ('dev', 'test', 'prod', etc..).
     */
    #[Env('APP_ENV')] public string $env = 'dev';

    /**
     * Debug mode (not minify HTML/CSS/JS if true).
     */
    #[Env('APP_DEBUG')] public bool $debug = false;

    /**
     * Treats errors except deprecations and notices as fatal.
     */
    #[Env('APP_STRICT')] public bool $strict = true;

    /**
     * Basic url (autodetect if null).
     */
    #[Env('APP_URL')] public ?string $url = null;

    /**
     * Default timezone.
     */
    public string $timezone = 'UTC';

    /**
     * Default mode for new directories.
     */
    public int $dirMode = 0777;

    /**
     * Default mode for new/updated files.
     */
    public int $fileMode = 0666;

    /**
     * Allow robots.
     */
    #[Env('APP_ROBOTS')] public bool $robots = false;

    /**
     * Application name.
     */
    public string $name = 'Simplest framework';

    /**
     * Default database.
     */
    public string $defaultDb = Mysql::class;

    /**
     * Mysql settings.
     *
     * @var mixed[] {@see Mysql}
     */
    #[Env('APP_DB_MYSQL')] public array $dbMysql = ['host' => 'localhost', 'port' => 3306, 'db' => null, 'user' => null, 'pass' => null];

    /**
     * Pgsql settings.
     *
     * @var mixed[] {@see Pgsql}
     */
    #[Env('APP_DB_PGSQL')] public array $dbPgsql = ['host' => 'localhost', 'port' => 5432, 'db' => null, 'user' => null, 'pass' => null];

    /**
     * Log slow queries.
     */
    public ?string $dbSlowQueryLog = APP_DIR . '/var/log/slow.queries.log';

    /**
     * Log slow queries with minimal time in seconds.
     */
    public float $dbSlowQueryMin = 0.5;

    /**
     * How many times retry failed transactions with expected sql states.
     */
    public int $transactionRetries = 7;

    /**
     * Log transactions fails.
     */
    public ?string $transactionFailLog = APP_DIR . '/var/log/transaction.fails.log';

    /**
     * Default cache.
     */
    #[Env('APP_DEFAULT_CACHE')] public string $defaultCache = Apc::class;

    /**
     * Apc settings.
     *
     * @var mixed[] {@see Apc}
     */
    public array $cacheApc = ['ns' => null, 'ttl' => 3600];

    /**
     * Memcached settings.
     *
     * @var mixed[] {@see Memcached}
     */
    public array $cacheMemcached = ['ns' => null, 'ttl' => 3600, 'servers' => [['127.0.0.1', 11211]]];

    /**
     * Redis settings.
     *
     * @var mixed[] {@see Redis}
     */
    public array $cacheRedis = ['ns' => null, 'ttl' => 3600, 'connect' => ['127.0.0.1', 6379, 2.5]];

    /**
     * Default template.
     */
    public string $defaultTemplate = Native::class;

    /**
     * Native settings.
     *
     * @var mixed[] {@see Native}
     */
    public array $templateNative = ['dir' => APP_DIR . '/templates', 'minify' => false];

    /**
     * Twig settings.
     *
     * @var mixed[] {@see Twig}
     */
    public array $templateTwig = ['dir' => APP_DIR . '/templates', 'cache' => APP_DIR . '/var/cache/twig'];

    /**
     * Xslt settings.
     *
     * @var mixed[] {@see Xslt}
     */
    public array $templateXslt = ['dir' => APP_DIR . '/templates'];

    /**
     * Mailer settings.
     *
     * @var mixed[] {@see Mailer}
     */
    #[Env('APP_MAILER')] public array $mailer = [
        'enabled' => false,
        'sender' => null,
        'recipients' => null,
        'replies' => null,
    ];

    /**
     * Assets merger settings.
     *
     * @var mixed[] {@see Merger}
     */
    public array $merger = [
        'location' => '/.merged',
        'dir' => APP_DIR . '/var/cache/merged',
        'docRoot' => APP_DIR . '/public',
        'cacheFile' => APP_DIR . '/var/cache/merger.php',
        'assets' => [
            'all.css' => APP_DIR . '/assets/css/*.css',
            'all.js' => APP_DIR . '/assets/js/*.js',
        ],
    ];

    /**
     * Compress output if size more this value in bytes.
     */
    public int $compressMin = 32 * 1024;

    /**
     * Compress output with only these mime types.
     *
     * @var string[]
     */
    public array $compressMimes = ['text/html', 'text/plain', 'application/json'];

    /**
     * Optional error document file.
     */
    public ?string $errorDocument = APP_DIR . '/public/.bin/errors/{CODE}.html.php';

    /**
     * Additional errors log file.
     */
    public ?string $errorLog = APP_DIR . '/var/log/errors.log';
}
