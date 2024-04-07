<?php declare(strict_types=1);

namespace App\Shared\Template;

use App\Shared\Config;
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
        $parameters = $this->s(Config::class)->templateXslt + [
            'globals' => [
                'registry' => $this->s(Registry::class),
            ],
        ];

        return new XsltTemplater(...$parameters);
    }
}
