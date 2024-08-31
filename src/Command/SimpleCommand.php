<?php declare(strict_types=1);

namespace App\Command;

use SWF\Attribute\AsCommand;
use SWF\CommandArgument;

class SimpleCommand
{
    /**
     * For run this command use: php bin/run say:hello
     */
    #[AsCommand(
        name: 'say:hello',
        description: 'Simple greeting command',
        params: [
            'name' => new CommandArgument(
                description: 'Your name',
            ),
        ],
    )]
    public function greeting(): void
    {
        echo sprintf("Hello, %s!\n", $_REQUEST['name'] ?? 'World');
    }
}
