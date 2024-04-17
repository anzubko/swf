<?php declare(strict_types=1);

namespace App\Shared;

use SWF\AbstractShared;
use SWF\CommonLogger;

/**
 * @mixin CommonLogger
 */
class Logger extends AbstractShared
{
    protected static function getInstance(): CommonLogger
    {
        return CommonLogger::getInstance();
    }
}
