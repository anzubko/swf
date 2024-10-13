<?php
declare(strict_types=1);

namespace App\Shared;

use SWF\CommandLineManager;

/**
 * @mixin CommandLineManager
 */
class Cli
{
    public static function getInstance(): CommandLineManager
    {
        return i(CommandLineManager::class);
    }
}
