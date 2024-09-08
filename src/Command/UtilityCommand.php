<?php declare(strict_types=1);

namespace App\Command;

use SWF\Attribute\AsCommand;
use SWF\CommandProvider;
use SWF\ControllerProvider;
use SWF\ListenerProvider;

class UtilityCommand
{
    #[AsCommand(
        name: 'list:commands',
        description: 'List all commands',
    )]
    public function listAllCommands(): void
    {
        CommandProvider::getInstance()->showAll();
    }

    #[AsCommand(
        name: 'list:controllers',
        description: 'List all controllers',
    )]
    public function listAllControllers(): void
    {
        ControllerProvider::getInstance()->showAll();
    }

    #[AsCommand(
        name: 'list:listeners',
        description: 'List all listeners',
    )]
    public function listAllListeners(): void
    {
        ListenerProvider::getInstance()->showAll();
    }
}
