<?php declare(strict_types=1);

namespace App\Shared\Template;

use App\Shared\Registry;
use SWF\AbstractShared;
use SWF\Interface\TemplaterInterface;
use SWF\XsltTemplater;

/**
 * @mixin TemplaterInterface
 */
class Xslt extends AbstractShared
{
    protected function getInstance(): TemplaterInterface
    {
        $parameters = config('template')->get('xslt');

        $parameters['globals'] = [
            'registry' => shared(Registry::class),
        ];

        return new XsltTemplater(...$parameters);
    }
}
