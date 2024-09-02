<?php declare(strict_types=1);

namespace App\Shared;

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
    public function mysql(callable $body, ?string $isolation = null, array $retryAt = []): self
    {
        TransactionRunner::run(
            db: instance(Mysql::class),
            body: $body,
            isolation: $isolation,
            retryAt: $retryAt,
            retries: config('transaction')->get('retries'),
        );

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
    public function pgsql(callable $body, ?string $isolation = null, array $retryAt = []): self
    {
        TransactionRunner::run(
            db: instance(Pgsql::class),
            body: $body,
            isolation: $isolation,
            retryAt: $retryAt,
            retries: config('transaction')->get('retries'),
        );

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
    public function run(callable $body, ?string $isolation = null, array $retryAt = []): self
    {
        TransactionRunner::run(
            db: instance(Db::class),
            body: $body,
            isolation: $isolation,
            retryAt: $retryAt,
            retries: config('transaction')->get('retries'),
        );

        return $this;
    }
}
