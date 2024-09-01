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
     * Namespaces where can be classes with controllers, commands, listeners, etc...
     *
     * array
     */
    'namespaces' => ['App\\'],

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

    /**
     * Custom log file.
     *
     * string|null
     */
    'customLog' => APP_DIR . '/var/log/{ENV}.log',
];
