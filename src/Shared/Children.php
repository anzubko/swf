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
     * @param class-string<T> $className
     *
     * @return iterable<T>
     *
     * @throws LogicException
     * @throws RuntimeException
     */
    public function get(string $className): iterable
    {
        foreach (RelationProvider::getInstance()->getChildren($className) as $child) {
            yield i($child);
        }
    }
}
