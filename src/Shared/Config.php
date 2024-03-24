<?php declare(strict_types=1);

namespace App\Shared;

use App\Config as AppConfig;
use SWF\AbstractConfig;
use SWF\AbstractShared;
use SWF\ConfigHolder;

/**
 * @mixin AppConfig
 */
class Config extends AbstractShared
{
    protected function getInstance(): AbstractConfig
    {
        return ConfigHolder::get();
    }
}
