<?php declare(strict_types=1);

namespace App\Command;

use SWF\Attribute\AsCommand;
use SWF\CommandProvider;
use SWF\ControllerProvider;
use SWF\ListenerProvider;

class UtilityCommand
{
    #[AsCommand(
        alias: 'list:commands',
        description: 'List all commands',
    )]
    public function listAllCommands(): void
    {
        i(CommandProvider::class)->showAll();
    }

    #[AsCommand(
        alias: 'list:controllers',
        description: 'List all controllers',
    )]
    public function listAllControllers(): void
    {
        i(ControllerProvider::class)->showAll();
    }

    #[AsCommand(
        alias: 'list:listeners',
        description: 'List all listeners',
    )]
    public function listAllListeners(): void
    {
        i(ListenerProvider::class)->showAll();
    }
}
