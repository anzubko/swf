<?php declare(strict_types=1);

namespace App\Shared;

use App\Config\TransactionConfig;
use SWF\Exception\DatabaserException;
use SWF\Interface\DatabaserInterface;
use SWF\TransactionDeclaration;
use SWF\TransactionRunner;
use Throwable;
use function count;

class Transaction
{
    /**
     * @var TransactionDeclaration[] $declarations
     */
    private array $declarations = [];

    public function with(DatabaserInterface $db, ?string $isolation = null, string ...$states): static
    {
        $this->declarations[] = new TransactionDeclaration($db, $isolation, $states);

        return $this;
    }

    /**
     * @throws DatabaserException
     * @throws Throwable
     */
    public function run(callable $body, ?int $retries = null): void
    {
        if (count($this->declarations) === 0) {
            $this->declarations[] = new TransactionDeclaration(i(Db::class));
        }

        i(TransactionRunner::class)->run($body, $this->declarations, $retries ?? i(TransactionConfig::class)->retries);

        $this->declarations = [];
    }
}
