<?php

return [
    /**
     * Environment mode ('dev', 'test', 'prod', etc..).
     *
     * string
     */
    'env' => env('APP_ENV', 'dev'),

    /**
     * Debug mode (not minify HTML/CSS/JS if true).
     *
     * bool
     */
    'debug' => env('APP_DEBUG', false),

    /**
     * Treats errors except deprecations and notices as fatal and sets Twig to strict mode.
     *
     * bool
     */
    'strict' => env('APP_STRICT', true),

    /**
     * Basic url (autodetect if null).
     *
     * string|null
     */
    'url' => env('APP_URL'),

    /**
     * Default timezone.
     *
     * string
     */
    'timezone' => 'UTC',

    /**
     * Default mode for created directories.
     *
     * int
     */
    'dirMode' => 0777,

    /**
     * Default mode for created/updated files.
     *
     * int
     */
    'fileMode' => 0666,
];
