<?php declare(strict_types=1);

namespace App\Command;

use App\Shared\Cli;
use SWF\Attribute\AsCommand;
use SWF\CommandArgument;

class SimpleCommand
{
    /**
     * For run this command use: php bin/run say:hello
     */
    #[AsCommand(
        alias: 'say:hello',
        description: 'Simple greeting command',
        params: [
            'name' => new CommandArgument(
                description: 'Your name',
            ),
        ],
    )]
    public function greeting(): void
    {
        $greeting = sprintf('Hello, %s!', $_REQUEST['name'] ?? 'World');

        i(Cli::class)->writeLn($greeting);
    }
}
