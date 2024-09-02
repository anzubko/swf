<?php declare(strict_types=1);

namespace App\Shared\Template;

use App\Shared\Registry;
use App\Shared\Router;
use App\Shared\Text;
use SWF\NativeTemplater;

/**
 * @mixin NativeTemplater
 */
class Native
{
    public static function getInstance(): NativeTemplater
    {
        $parameters = config('template')->get('native');

        $parameters['debug'] = config('system')->get('debug');

        $parameters['globals']['registry'] = instance(Registry::class);

        $parameters['functions']['genUrl'] = instance(Router::class)->genUrl(...);

        $parameters['functions']['genAbsoluteUrl'] = instance(Router::class)->genAbsoluteUrl(...);

        $parameters['functions']['lc'] = instance(Text::class)->lc(...);

        $parameters['functions']['lcFirst'] = instance(Text::class)->lcFirst(...);

        $parameters['functions']['uc'] = instance(Text::class)->uc(...);

        $parameters['functions']['ucFirst'] = instance(Text::class)->ucFirst(...);

        $parameters['functions']['trim'] = instance(Text::class)->trim(...);

        $parameters['functions']['rTrim'] = instance(Text::class)->rTrim(...);

        $parameters['functions']['lTrim'] = instance(Text::class)->lTrim(...);

        $parameters['functions']['fTrim'] = instance(Text::class)->fTrim(...);

        $parameters['functions']['mTrim'] = instance(Text::class)->mTrim(...);

        $parameters['functions']['cut'] = instance(Text::class)->cut(...);

        $parameters['functions']['random'] = instance(Text::class)->random(...);

        return new NativeTemplater(...$parameters);
    }
}
