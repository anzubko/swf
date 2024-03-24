<?php declare(strict_types=1);

namespace App\Shared;

use SWF\AbstractShared;
use SWF\AssetsMerger;

/**
 * @mixin AssetsMerger
 */
class Merger extends AbstractShared
{
    protected function getInstance(): AssetsMerger
    {
        return new AssetsMerger(...$this->s(Config::class)->merger);
    }
}
