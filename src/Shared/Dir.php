<?php declare(strict_types=1);

namespace App\Shared;

use RuntimeException;
use SWF\DirHandler;

class Dir
{
    /**
     * Scans directory.
     *
     * @return string[]
     */
    public function scan(string $dir, bool $recursive = false, bool $withDir = false, int $order = SCANDIR_SORT_ASCENDING): array
    {
        return DirHandler::scan($dir, $recursive, $withDir, $order);
    }

    /**
     * Creates directory.
     */
    public function create(string $dir): bool
    {
        return DirHandler::create($dir);
    }

    /**
     * Removes directory.
     */
    public function remove(string $dir, bool $recursive = true): bool
    {
        return DirHandler::remove($dir, $recursive);
    }

    /**
     * Clears directory.
     */
    public function clear(string $dir, bool $recursive = true): bool
    {
        return DirHandler::clear($dir, $recursive);
    }

    /**
     * Copies directory.
     */
    public function copy(string $source, string $target): bool
    {
        return DirHandler::copy($source, $target);
    }

    /**
     * Moves directory.
     */
    public function move(string $source, string $target): bool
    {
        return DirHandler::move($source, $target);
    }

    /**
     * Makes temporary directory.
     *
     * @throws RuntimeException
     */
    public function temporary(): string
    {
        return DirHandler::temporary();
    }
}
