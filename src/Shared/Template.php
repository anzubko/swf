<?php declare(strict_types=1);

namespace App\Shared;

use SWF\Interface\TemplaterInterface;

/**
 * @mixin TemplaterInterface
 */
class Template
{
    public static function getInstance(): TemplaterInterface
    {
        return i(config('template')->get('default'));
    }
}
