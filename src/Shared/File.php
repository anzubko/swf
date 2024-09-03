<?php declare(strict_types=1);

namespace App\Shared;

use SWF\FileHandler;

class File
{
    /**
     * Gets file contents as string.
     */
    public function get(string $file): ?string
    {
        return FileHandler::get($file);
    }

    /**
     * Puts contents to file.
     */
    public function put(string $file, mixed $contents, int $flags = 0, bool $createDir = true): bool
    {
        return FileHandler::put($file, $contents, $flags, $createDir);
    }

    /**
     * Puts variable to some PHP file.
     */
    public function putVar(string $file, mixed $variable, int $flags = 0, bool $createDir = true): bool
    {
        return FileHandler::putVar($file, $variable, $flags, $createDir);
    }

    /**
     * Removes file.
     */
    public function remove(string $file): bool
    {
        return FileHandler::remove($file);
    }

    /**
     * Copies file.
     */
    public function copy(string $source, string $target, bool $createDir = true): bool
    {
        return FileHandler::copy($source, $target, $createDir);
    }

    /**
     * Moves file.
     */
    public function move(string $source, string $target, bool $createDir = true): bool
    {
        return FileHandler::move($source, $target, $createDir);
    }

    /**
     * Gets some file statistics.
     *
     * @return array{name:string, size:int, modified:int, created:int, w:int, h:int, type:string|null}|null
     */
    public function stats(string $file): ?array
    {
        return FileHandler::stats($file);
    }
}
