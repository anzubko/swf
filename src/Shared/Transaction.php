<?php declare(strict_types=1);

namespace App\Shared;

use SWF\TransactionRunner;

/**
 * @mixin TransactionRunner
 */
class Transaction
{
    public static function getInstance(): TransactionRunner
    {
        return new TransactionRunner(i(Db::class));
    }
}
