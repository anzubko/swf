<?php declare(strict_types=1);

namespace App\Config;

use SWF\AbstractConfig;

class TransactionConfig extends AbstractConfig
{
    /**
     * How many times retry failed transactions with expected sql states.
     */
    public int $retries = 3;

    /**
     * Log transactions fails.
     */
    public ?string $failLog = APP_DIR . '/var/log/transaction.fails.log';
}
