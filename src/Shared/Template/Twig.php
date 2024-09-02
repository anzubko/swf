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

        $parameters['globals']['registry'] = instance(Registry::class);

        $parameters['functions']['genAbsoluteUrl'] = instance(Router::class)->genAbsoluteUrl(...);

        $parameters['functions']['genUrl'] = instance(Router::class)->genUrl(...);

        $parameters['functions']['lcFirst'] = instance(Text::class)->lcFirst(...);

        $parameters['functions']['lc'] = instance(Text::class)->lc(...);

        $parameters['functions']['ucFirst'] = instance(Text::class)->ucFirst(...);

        $parameters['functions']['uc'] = instance(Text::class)->uc(...);

        $parameters['functions']['trim'] = instance(Text::class)->trim(...);

        $parameters['functions']['lTrim'] = instance(Text::class)->lTrim(...);

        $parameters['functions']['rTrim'] = instance(Text::class)->rTrim(...);

        $parameters['functions']['fTrim'] = instance(Text::class)->fTrim(...);

        $parameters['functions']['mTrim'] = instance(Text::class)->mTrim(...);

        $parameters['functions']['cut'] = instance(Text::class)->cut(...);

        $parameters['functions']['random'] = instance(Text::class)->random(...);

        return new TwigTemplater(...$parameters);
    }
}
