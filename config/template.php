<?php

use App\Shared\Template\Native;
use App\Shared\Template\Twig;
use App\Shared\Template\Xslt;

return [
    /**
     * Default template.
     */
    'default' => Native::class,

    /**
     * Native settings.
     *
     * mixed[] {@see Native}
     */
    'native' => ['dir' => APP_DIR . '/templates', 'minify' => false],

    /**
     * Twig settings.
     *
     * mixed[] {@see Twig}
     */
    'twig' => ['dir' => APP_DIR . '/templates', 'cache' => APP_DIR . '/var/cache/twig'],

    /**
     * Xslt settings.
     *
     * mixed[] {@see Xslt}
     */
    'xslt' => ['dir' => APP_DIR . '/templates'],
];
