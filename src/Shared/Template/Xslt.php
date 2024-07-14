<?php declare(strict_types=1);

namespace App\Shared\Template;

use App\Shared\Registry;
use SWF\AbstractShared;
use SWF\XsltTemplater;

/**
 * @mixin XsltTemplater
 */
class Xslt extends AbstractShared
{
    protected static function getInstance(): XsltTemplater
    {
        $parameters = config('template')->get('xslt');

        $parameters['globals'] = [
            'registry' => shared(Registry::class),
        ];

        return new XsltTemplater(...$parameters);
    }
}
