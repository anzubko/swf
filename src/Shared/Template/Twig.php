<?php declare(strict_types=1);

namespace App\Shared\Template;

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
        $parameters = config('template')->get('twig');

        $parameters['debug'] = config('system')->get('debug');

        $parameters['reload'] = 'prod' !== config('system')->get('env');

        $parameters['globals']['registry'] = i(Registry::class);

        $parameters['functions']['genAbsoluteUrl'] = i(Router::class)->genAbsoluteUrl(...);

        $parameters['functions']['genUrl'] = i(Router::class)->genUrl(...);

        $parameters['functions']['lcFirst'] = i(Text::class)->lcFirst(...);

        $parameters['functions']['lc'] = i(Text::class)->lc(...);

        $parameters['functions']['ucFirst'] = i(Text::class)->ucFirst(...);

        $parameters['functions']['uc'] = i(Text::class)->uc(...);

        $parameters['functions']['trim'] = i(Text::class)->trim(...);

        $parameters['functions']['lTrim'] = i(Text::class)->lTrim(...);

        $parameters['functions']['rTrim'] = i(Text::class)->rTrim(...);

        $parameters['functions']['fTrim'] = i(Text::class)->fTrim(...);

        $parameters['functions']['mTrim'] = i(Text::class)->mTrim(...);

        $parameters['functions']['cut'] = i(Text::class)->cut(...);

        $parameters['functions']['random'] = i(Text::class)->random(...);

        return new TwigTemplater(...$parameters);
    }
}
