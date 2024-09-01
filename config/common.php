<?php

return [
    /**
     * Allow robots.
     *
     * bool
     */
    'robots' => env('APP_ROBOTS', false),

    /**
     * Application name.
     *
     * string
     */
    'name' => 'Simplest framework',

    /**
     * Optional error document file.
     *
     * string|null
     */
    'errorDocument' => APP_DIR . '/public/.bin/errors/{CODE}.html.php',

    /**
     * Mailer settings.
     *
     * mixed[] {@see App\Shared\Mailer}
     */
    'mailer' => [
        'enabled' => env('APP_MAILER_ENABLED', true),
        'sender' => env('APP_MAILER_SENDER'),
        'recipients' => env('APP_MAILER_RECIPIENTS'),
        'replies' => env('APP_MAILER_REPLIES'),
    ],

    /**
     * Assets merger settings.
     *
     * mixed[] {@see App\Shared\Merger}
     */
    'merger' => [
        'location' => '/.merged',
        'dir' => APP_DIR . '/var/cache/merged',
        'docRoot' => APP_DIR . '/public',
        'metricsFile' => APP_DIR . '/var/cache/merger.metrics.php',
        'assets' => [
            'all.css' => APP_DIR . '/assets/css/*.css',
            'all.js' => APP_DIR . '/assets/js/*.js',
        ],
    ],
];
