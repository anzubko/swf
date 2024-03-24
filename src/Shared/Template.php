<?php declare(strict_types=1);

namespace App\Shared;

use SWF\AbstractShared;
use SWF\Interface\TemplaterInterface;

/**
 * @mixin TemplaterInterface
 */
class Template extends AbstractShared
{
    protected function getInstance(): TemplaterInterface
    {
        return $this->s($this->s(Config::class)->defaultTemplate);
    }
}
