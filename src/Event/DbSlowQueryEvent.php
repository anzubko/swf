<?php declare(strict_types=1);

namespace App\Event;

use SWF\AbstractEvent;

class DbSlowQueryEvent extends AbstractEvent
{
    /**
     * @param string[] $queries
     */
    public function __construct(
        public readonly float $timer,
        public readonly array $queries,
    ) {
    }
}
