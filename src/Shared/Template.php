<?php declare(strict_types=1);

namespace App\Shared;

use SWF\AbstractShared;
use SWF\Interface\TemplaterInterface;

/**
 * @mixin TemplaterInterface
 */
class Template extends AbstractShared
{
    protected static function getInstance(): TemplaterInterface
    {
        return shared(config('template')->get('default'));
    }
}
