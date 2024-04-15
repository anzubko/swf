<?php declare(strict_types=1);

namespace App\Shared;

use SWF\AbstractShared;
use SWF\ConfigGetter;

/**
 * @mixin ConfigGetter
 */
class Config extends AbstractShared
{
    protected function getInstance(): ConfigGetter
    {
        return ConfigGetter::getInstance();
    }
}
