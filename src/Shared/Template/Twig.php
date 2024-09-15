<?php declare(strict_types=1);

namespace App\Shared\Template;

use App\Config\SystemConfig;
use App\Config\TemplateConfig;
use App\Shared\Registry;
use App\Shared\Router;
use App\Shared\Text;
use SWF\Exception\TemplaterException;
use SWF\TwigTemplater;

/**
 * @mixin TwigTemplater
 */
class Twig
{
    /**
     * @throws TemplaterException
     */
    public static function getInstance(): TwigTemplater
    {
        $parameters = i(TemplateConfig::class)->twig;

        $parameters['debug'] = i(SystemConfig::class)->debug;

        $parameters['reload'] = 'prod' !== i(SystemConfig::class)->env;

        $parameters['globals'] = [
            'registry' => i(Registry::class),
        ];

        $parameters['functions'] = [
            'genAbsoluteUrl' => i(Router::class)->genAbsoluteUrl(...),
            'genUrl' => i(Router::class)->genUrl(...),
            'lcFirst' => i(Text::class)->lcFirst(...),
            'lc' => i(Text::class)->lc(...),
            'ucFirst' => i(Text::class)->ucFirst(...),
            'uc' => i(Text::class)->uc(...),
            'trim' => i(Text::class)->trim(...),
            'lTrim' => i(Text::class)->lTrim(...),
            'rTrim' => i(Text::class)->rTrim(...),
            'fTrim' => i(Text::class)->fTrim(...),
            'mTrim' => i(Text::class)->mTrim(...),
            'cut' => i(Text::class)->cut(...),
            'random' => i(Text::class)->random(...),
        ];

        return new TwigTemplater(...$parameters);
    }
}
