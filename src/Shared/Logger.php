<?php declare(strict_types=1);

namespace App\Shared;

use SWF\AbstractShared;
use SWF\CommonLogger;
use SWF\InstanceHolder;

/**
 * @mixin CommonLogger
 */
class Logger extends AbstractShared
{
    protected function getInstance(): CommonLogger
    {
        return InstanceHolder::get(CommonLogger::class);
    }
}
