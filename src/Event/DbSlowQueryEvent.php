<?php declare(strict_types=1);

namespace App\Event;

use SWF\AbstractEvent;

class DbSlowQueryEvent extends AbstractEvent
{
    /**
     * @param string[] $queries
     */
    public function __construct(
        private readonly float $timer,
        private readonly array $queries,
    ) {
    }

    public function getTimer(): float
    {
        return $this->timer;
    }

    /**
     * @return string[]
     */
    public function getQueries(): array
    {
        return $this->queries;
    }
}
