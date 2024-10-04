<?php declare(strict_types=1);

namespace App\Shared;

use LogicException;
use RuntimeException;
use SWF\RelationProvider;

class Children
{
    /**
     * Accesses child classes instances of some class/interface.
     *
     * @template T
     *
     * @param class-string<T> $class
     *
     * @return iterable<T>
     *
     * @throws LogicException
     * @throws RuntimeException
     */
    public function get(string $class): iterable
    {
        foreach (i(RelationProvider::class)->getChildren($class) as $child) {
            yield i($child);
        }
    }
}
