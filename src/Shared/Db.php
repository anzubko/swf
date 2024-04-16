<?php declare(strict_types=1);

namespace App\Shared;

use SWF\AbstractShared;
use SWF\Interface\DatabaserInterface;

/**
 * @mixin DatabaserInterface
 */
class Db extends AbstractShared
{
    protected function getInstance(): DatabaserInterface
    {
        return shared(config('db')->get('default'));
    }
}
