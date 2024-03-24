<?php declare(strict_types=1);

namespace App\Command;

use SWF\AbstractBase;
use SWF\Attribute\AsCommand;

class SimpleCommand extends AbstractBase
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
