<?php
declare(strict_types=1);

namespace App\Shared\Template;

use App\Config\TemplateConfig;
use App\Shared\Registry;
use SWF\XsltTemplater;

/**
 * @mixin XsltTemplater
 */
class Xslt
{
    public static function getInstance(): XsltTemplater
    {
        $parameters = i(TemplateConfig::class)->xslt;

        $parameters['globals']['registry'] = i(Registry::class);

        return new XsltTemplater(...$parameters);
    }
}
