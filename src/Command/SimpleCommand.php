<?php declare(strict_types=1);

namespace App\Command;

use SWF\Attribute\AsCommand;

class SimpleCommand
{
    /**
     * For run this command use: php bin/run say:hello:world
     */
    #[AsCommand('say:hello:world')]
    public function greeting(): void
    {
        echo "Hello World!\n";
    }
}
