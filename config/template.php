<?php

return [
    /**
     * Default template.
     */
    'default' => App\Shared\Template\Native::class,

    /**
     * Native settings.
     *
     * mixed[] {@see App\Shared\Template\Native}
     */
    'native' => [
        'dir' => APP_DIR . '/templates',
        'minify' => false,
    ],

    /**
     * Twig settings.
     *
     * mixed[] {@see App\Shared\Template\Twig}
     */
    'twig' => [
        'dir' => APP_DIR . '/templates',
        'cache' => APP_DIR . '/var/cache/twig',
    ],

    /**
     * Xslt settings.
     *
     * mixed[] {@see App\Shared\Template\Xslt}
     */
    'xslt' => [
        'dir' => APP_DIR . '/templates',
    ],
];
