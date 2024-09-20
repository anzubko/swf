<?php declare(strict_types=1);

namespace App\Shared;

use Exception;
use SWF\CmdManager;
use SWF\Exception\ExitSimulationException;

class Cmd
{
    /**
     * Wrapped echo.
     */
    public function write(string $string = ''): self
    {
        i(CmdManager::class)->write($string);

        return $this;
    }

    /**
     * Wrapped echo with new line.
     */
    public function writeLn(string $string = ''): self
    {
        i(CmdManager::class)->writeLn($string);

        return $this;
    }

    /**
     * Shows error message through regular exception.
     *
     * @throws Exception
     */
    public function error(string $message, int $code = 1): never
    {
        i(CmdManager::class)->error($message, $code);
    }

    /**
     * Exit call simulation through special exception.
     *
     * @throws ExitSimulationException
     */
    public function exit(): never
    {
        i(CmdManager::class)->exit();
    }
}
