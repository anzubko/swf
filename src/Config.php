<?php declare(strict_types=1);

namespace App;

use App\Shared\Cache\Apc;
use App\Shared\Db\Mysql;
use App\Shared\Template\Native;
use SWF\AbstractConfig;
use SWF\ApcCacher;
use SWF\AssetsMerger;
use SWF\Attribute\Env;
use SWF\Databaser;
use SWF\MemCacher;
use SWF\MysqlDatabaser;
use SWF\NativeTemplater;
use SWF\PgsqlDatabaser;
use SWF\RedisCacher;
use SWF\SimpleMailer;
use SWF\TwigTemplater;
use SWF\XsltTemplater;

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
    public bool $strict = true;

    /**
     * Basic url (autodetect if null).
     */
    #[Env('APP_URL')] public ?string $url = null;

    /**
     * Default timezone.
     */
    public string $timezone = 'UTC';

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
     * @var mixed[]
     *
     * @see MysqlDatabaser
     */
    #[Env('APP_DB_MYSQL')] public array $dbMysql = [
        'host' => 'localhost',
        'port' => 3306,
        'db' => null,
        'user' => null,
        'pass' => null,
        'persistent' => false,
        'charset' => 'utf8mb4',
        'camelize' => true,
        'mode' => Databaser::ASSOC,
    ];

    /**
     * Pgsql settings.
     *
     * @var mixed[]
     *
     * @see PgsqlDatabaser
     */
    #[Env('APP_DB_PGSQL')] public array $dbPgsql = [
        'host' => 'localhost',
        'port' => 5432,
        'db' => null,
        'user' => null,
        'pass' => null,
        'persistent' => false,
        'charset' => 'utf-8',
        'camelize' => true,
        'mode' => Databaser::ASSOC,
    ];

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
     * @var mixed[]
     *
     * @see ApcCacher
     */
    public array $cacheApc = [
        'ttl' => 3600,
        'ns' => null,
    ];

    /**
     * Memcached settings.
     *
     * @var mixed[]
     *
     * @see MemCacher
     */
    public array $cacheMemcached = [
        'ttl' => 3600,
        'ns' => null,
        'servers' => [['127.0.0.1', 11211]],
        'options' => [],
    ];

    /**
     * Redis settings.
     *
     * @var mixed[]
     *
     * @see RedisCacher
     */
    public array $cacheRedis = [
        'ttl' => 3600,
        'ns' => null,
        'connect' => ['127.0.0.1', 6379, 2.5],
        'options' => [],
    ];

    /**
     * Default template.
     */
    public string $defaultTemplate = Native::class;

    /**
     * Native settings.
     *
     * @var mixed[]
     *
     * @see NativeTemplater
     */
    public array $templateNative = [
        'dir' => APP_DIR . '/templates',
        'minify' => false,
    ];

    /**
     * Twig settings.
     *
     * @var mixed[]
     *
     * @see TwigTemplater
     */
    public array $templateTwig = [
        'dir' => APP_DIR . '/templates',
        'cache' => APP_DIR . '/var/cache/twig',
        'strict' => true,
    ];

    /**
     * Xslt settings.
     *
     * @var mixed[]
     *
     * @see XsltTemplater
     */
    public array $templateXslt = [
        'dir' => APP_DIR . '/templates',
        'root' => 'root',
        'item' => 'item',
    ];

    /**
     * Mailer settings.
     *
     * @var mixed[]
     *
     * @see SimpleMailer
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
     * @var mixed[]
     *
     * @see AssetsMerger
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
     * Optional error document file.
     */
    public ?string $errorDocument = APP_DIR . '/public/.bin/errors/{CODE}.html.php';

    /**
     * Compress output if size more this value in bytes.
     */
    public int $compressMin = 32 * 1024;

    /**
     * Compress output with only these mime types.
     *
     * @var string[]
     */
    public array $compressMimes = [
        'text/html',
        'text/plain',
        'text/xml',
        'text/css',
        'application/x-javascript',
        'application/javascript',
        'application/ecmascript',
        'application/rss+xml',
        'application/xml',
    ];

    /**
     * Default mode for new directories.
     */
    public int $dirMode = 0777;

    /**
     * Default mode for new/updated files.
     */
    public int $fileMode = 0666;

    /**
     * Additional errors log file.
     */
    public ?string $errorLog = APP_DIR . '/var/log/errors.log';
}
