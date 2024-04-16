<?php declare(strict_types=1);

namespace App\Shared\Template;

use App\Shared\Registry;
use App\Shared\Router;
use App\Shared\Text;
use SWF\AbstractShared;
use SWF\Exception\TemplaterException;
use SWF\Interface\TemplaterInterface;
use SWF\TwigTemplater;

/**
 * @mixin TemplaterInterface
 */
class Twig extends AbstractShared
{
    /**
     * @throws TemplaterException
     */
    protected function getInstance(): TemplaterInterface
    {
        $parameters = config('template')->get('twig');

        $parameters['strict'] = config('system')->get('strict');

        $parameters['debug'] = config('system')->get('debug');

        $parameters['reload'] = 'prod' !== config('system')->get('env');

        $parameters['globals']['registry'] = shared(Registry::class);

        $parameters['functions']['genUrl'] = shared(Router::class)->genUrl(...);

        $parameters['functions']['genAbsoluteUrl'] = shared(Router::class)->genAbsoluteUrl(...);

        $parameters['functions']['lc'] = shared(Text::class)->lc(...);

        $parameters['functions']['lcFirst'] = shared(Text::class)->lcFirst(...);

        $parameters['functions']['uc'] = shared(Text::class)->uc(...);

        $parameters['functions']['ucFirst'] = shared(Text::class)->ucFirst(...);

        $parameters['functions']['trim'] = shared(Text::class)->trim(...);

        $parameters['functions']['rTrim'] = shared(Text::class)->rTrim(...);

        $parameters['functions']['lTrim'] = shared(Text::class)->lTrim(...);

        $parameters['functions']['fTrim'] = shared(Text::class)->fTrim(...);

        $parameters['functions']['mTrim'] = shared(Text::class)->mTrim(...);

        $parameters['functions']['cut'] = shared(Text::class)->cut(...);

        $parameters['functions']['random'] = shared(Text::class)->random(...);

        return new TwigTemplater(...$parameters);
    }
}
