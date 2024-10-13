<?php
declare(strict_types=1);

namespace App\Shared;

use Exception;
use SWF\CommandLineManager;
use SWF\Exception\ExitSimulationException;

class Cli
{
    /**
     * Gets quiet status.
     */
    public function isQuiet(): bool
    {
        return CommandLineManager::isQuiet();
    }

    /**
     * Sets quiet status.
     *
     * Automatically sets to true when command called with --quiet option.
     */
    public function setQuiet(bool $quiet): static
    {
        CommandLineManager::setQuiet($quiet);

        return $this;
    }

    /**
     * Wrapped echo.
     */
    public function write(string $string = ''): static
    {
        CommandLineManager::write($string);

        return $this;
    }

    /**
     * Wrapped echo with new line.
     */
    public function writeLn(string $string = ''): static
    {
        CommandLineManager::writeLn($string);

        return $this;
    }

    /**
     * Shows error message through regular exception and calls real exit() with code from 1 to 254.
     *
     * @throws Exception
     */
    public function error(string $message = '', int $code = 1): never
    {
        CommandLineManager::error($message, $code);
    }

    /**
     * Exits from current command through special exception.
     *
     * @throws ExitSimulationException
     */
    public function end(): never
    {
        CommandLineManager::end();
    }
}
