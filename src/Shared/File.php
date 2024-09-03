<?php declare(strict_types=1);

namespace App\Shared;

use SWF\FileHandler;

class File
{
    /**
     * Getting file contents into string.
     */
    public function get(string $file): ?string
    {
        return FileHandler::get($file);
    }

    /**
     * Putting contents to file.
     */
    public function put(string $file, mixed $contents, int $flags = 0, bool $createDir = true): bool
    {
        return FileHandler::put($file, $contents, $flags, $createDir);
    }

    /**
     * Putting variable to some PHP file.
     */
    public function putVar(string $file, mixed $variable, int $flags = 0, bool $createDir = true): bool
    {
        return FileHandler::putVar($file, $variable, $flags, $createDir);
    }

    /**
     * File removing.
     */
    public function remove(string $file): bool
    {
        return FileHandler::remove($file);
    }

    /**
     * File coping.
     */
    public function copy(string $source, string $target, bool $createDir = true): bool
    {
        return FileHandler::copy($source, $target, $createDir);
    }

    /**
     * File moving.
     */
    public function move(string $source, string $target, bool $createDir = true): bool
    {
        return FileHandler::move($source, $target, $createDir);
    }

    /**
     * Getting some file statistics.
     *
     * @return array{name:string, size:int, modified:int, created:int, w:int, h:int, type:string|null}|null
     */
    public function stats(string $file): ?array
    {
        return FileHandler::stats($file);
    }
}
