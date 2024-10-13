<?php
declare(strict_types=1);

namespace App\Shared;

use SWF\SubclassProvider;

/**
 * @mixin SubclassProvider
 */
class Subclass
{
    public static function getInstance(): SubclassProvider
    {
        return i(SubclassProvider::class);
    }
}
