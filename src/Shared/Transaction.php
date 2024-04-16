<?php declare(strict_types=1);

namespace App\Shared;

use App\Shared\Db\Mysql;
use App\Shared\Db\Pgsql;
use SWF\AbstractShared;
use SWF\Exception\DatabaserException;
use SWF\InstanceHolder;
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
        InstanceHolder::get(TransactionRunner::class)->run(
            shared(Mysql::class),
            $body,
            $isolation,
            $retryAt,
            config('transaction')->get('retries'),
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
        InstanceHolder::get(TransactionRunner::class)->run(
            shared(Pgsql::class),
            $body,
            $isolation,
            $retryAt,
            config('transaction')->get('retries'),
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
        InstanceHolder::get(TransactionRunner::class)->run(
            shared(Db::class),
            $body,
            $isolation,
            $retryAt,
            config('transaction')->get('retries'),
        );

        return $this;
    }
}
