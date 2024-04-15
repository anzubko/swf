<?php

return [
    /**
     * Environment mode ('dev', 'test', 'prod', etc..).
     */
    'env' => env('APP_ENV', 'dev'),

    /**
     * Debug mode (not minify HTML/CSS/JS if true).
     */
    'debug' => env('APP_DEBUG', false),

    /**
     * Treats errors except deprecations and notices as fatal and sets Twig to strict mode.
     */
    'strict' => env('APP_STRICT', true),

    /**
     * Basic url (autodetect if null).
     */
    'url' => env('APP_URL'),

    /**
     * Default timezone.
     */
    'timezone' => 'UTC',

    /**
     * Default mode for created directories.
     */
    'dirMode' => 0777,

    /**
     * Default mode for created/updated files.
     */
    'fileMode' => 0666,
];
