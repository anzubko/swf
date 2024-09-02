<?php declare(strict_types=1);

namespace App\Shared\Template;

use App\Shared\Registry;
use SWF\XsltTemplater;

/**
 * @mixin XsltTemplater
 */
class Xslt
{
    public static function getInstance(): XsltTemplater
    {
        $parameters = config('template')->get('xslt');

        $parameters['globals']['registry'] = instance(Registry::class);

        return new XsltTemplater(...$parameters);
    }
}
