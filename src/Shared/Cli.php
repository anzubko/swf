<?php declare(strict_types=1);

namespace App\Shared;

use Exception;
use SWF\CommandLineManager;
use SWF\Exception\ExitSimulationException;

class Cli
{
    /**
     * Wrapped echo.
     */
    public function write(string $string = ''): self
    {
        i(CommandLineManager::class)->write($string);

        return $this;
    }

    /**
     * Wrapped echo with new line.
     */
    public function writeLn(string $string = ''): self
    {
        i(CommandLineManager::class)->writeLn($string);

        return $this;
    }

    /**
     * Shows error message through regular exception.
     *
     * @throws Exception
     */
    public function error(string $message, int $code = 1): never
    {
        i(CommandLineManager::class)->error($message, $code);
    }

    /**
     * Exit call simulation through special exception.
     *
     * @throws ExitSimulationException
     */
    public function exit(): never
    {
        i(CommandLineManager::class)->exit();
    }
}
