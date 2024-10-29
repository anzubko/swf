<?php
declare(strict_types=1);

namespace App\Config;

use App\Shared\Template\Native;
use SWF\AbstractConfig;

class TemplateConfig extends AbstractConfig
{
    /**
     * Default template.
     *
     * @var class-string
     */
    public string $default = Native::class;

    /**
     * Native settings.
     *
     * @var mixed[]
     */
    public array $native = [
        'dir' => APP_DIR . '/templates',
        'minify' => false,
    ];

    /**
     * Twig settings.
     *
     * @var mixed[]
     */
    public array $twig = [
        'dir' => APP_DIR . '/templates',
        'cache' => APP_DIR . '/var/cache/twig',
    ];

    /**
     * Xslt settings.
     *
     * @var mixed[]
     */
    public array $xslt = [
        'dir' => APP_DIR . '/templates',
    ];
}
