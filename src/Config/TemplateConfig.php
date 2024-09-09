<?php declare(strict_types=1);

namespace App\Config;

use App\Shared\Template\Native;
use App\Shared\Template\Twig;
use App\Shared\Template\Xslt;
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
     * @see Native
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
     * @see Twig
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
     * @see Xslt
     *
     * @var mixed[]
     */
    public array $xslt = [
        'dir' => APP_DIR . '/templates',
    ];
}
