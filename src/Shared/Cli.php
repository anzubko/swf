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
     * Shows error message through regular exception and calls real exit() with code from 1 to 254.
     *
     * @throws Exception
     */
    public function error(string $message = '', int $code = 1): never
    {
        i(CommandLineManager::class)->error($message, $code);
    }

    /**
     * Exit(0) call simulation through special exception.
     *
     * @throws ExitSimulationException
     */
    public function exit(): never
    {
        i(CommandLineManager::class)->exit();
    }
}
