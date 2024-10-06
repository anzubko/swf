<?php declare(strict_types=1);

namespace App\Shared;

use App\Config\TransactionConfig;
use App\Shared\Db\Mysql;
use App\Shared\Db\Pgsql;
use SWF\Exception\DatabaserException;
use SWF\TransactionRunner;
use Throwable;

class Transaction
{
    /**
     * Processes Mysql transaction with retries at expected errors.
     *
     * @param string[] $retryAt
     *
     * @throws DatabaserException
     * @throws Throwable
     */
    public function mysql(callable $body, ?string $isolation = null, array $retryAt = []): static
    {
        i(TransactionRunner::class)->run(i(Mysql::class), $body, $isolation, $retryAt, i(TransactionConfig::class)->retries);

        return $this;
    }

    /**
     * Processes Pgsql transaction with retries at expected errors.
     *
     * @param string[] $retryAt
     *
     * @throws DatabaserException
     * @throws Throwable
     */
    public function pgsql(callable $body, ?string $isolation = null, array $retryAt = []): static
    {
        i(TransactionRunner::class)->run(i(Pgsql::class), $body, $isolation, $retryAt, i(TransactionConfig::class)->retries);

        return $this;
    }

    /**
     * Processes transaction with retries at expected errors.
     *
     * @param string[] $retryAt
     *
     * @throws DatabaserException
     * @throws Throwable
     */
    public function run(callable $body, ?string $isolation = null, array $retryAt = []): static
    {
        i(TransactionRunner::class)->run(i(Db::class), $body, $isolation, $retryAt, i(TransactionConfig::class)->retries);

        return $this;
    }
}
