<?php

return [
    /**
     * How many times retry failed transactions with expected sql states.
     *
     * int
     */
    'retries' => 3,

    /**
     * Log transactions fails.
     *
     * string|null
     */
    'failLog' => APP_DIR . '/var/log/transaction.fails.log',
];
