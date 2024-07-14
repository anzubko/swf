<?php declare(strict_types=1);

namespace App\Shared;

use App\Shared\Db\Mysql;
use App\Shared\Db\Pgsql;
use SWF\AbstractShared;
use SWF\Exception\DatabaserException;
use SWF\TransactionRunner;
use Throwable;

class Transaction extends AbstractShared
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
            db: shared(Mysql::class),
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
            db: shared(Pgsql::class),
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
            db: shared(Db::class),
            body: $body,
            isolation: $isolation,
            retryAt: $retryAt,
            retries: config('transaction')->get('retries'),
        );

        return $this;
    }
}
