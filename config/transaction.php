<?php

return [
    /**
     * How many times retry failed transactions with expected sql states.
     *
     * int
     */
    'retries' => 7,

    /**
     * Log transactions fails.
     *
     * string|null
     */
    'failLog' => APP_DIR . '/var/log/transaction.fails.log',
];
