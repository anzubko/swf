<?php
declare(strict_types=1);

namespace App\Shared;

use App\Config\CommonConfig;
use SWF\AssetsMerger;

/**
 * @mixin AssetsMerger
 */
class Merger
{
    public static function getInstance(): AssetsMerger
    {
        return new AssetsMerger(...i(CommonConfig::class)->merger);
    }
}
