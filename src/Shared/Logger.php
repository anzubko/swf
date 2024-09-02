<?php declare(strict_types=1);

namespace App\Shared;

use SWF\CommonLogger;

/**
 * @mixin CommonLogger
 */
class Logger
{
    public static function getInstance(): CommonLogger
    {
        return CommonLogger::getInstance();
    }
}
