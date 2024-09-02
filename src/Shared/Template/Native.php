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

        $parameters['globals']['registry'] = i(Registry::class);

        $parameters['functions']['genUrl'] = i(Router::class)->genUrl(...);

        $parameters['functions']['genAbsoluteUrl'] = i(Router::class)->genAbsoluteUrl(...);

        $parameters['functions']['lc'] = i(Text::class)->lc(...);

        $parameters['functions']['lcFirst'] = i(Text::class)->lcFirst(...);

        $parameters['functions']['uc'] = i(Text::class)->uc(...);

        $parameters['functions']['ucFirst'] = i(Text::class)->ucFirst(...);

        $parameters['functions']['trim'] = i(Text::class)->trim(...);

        $parameters['functions']['rTrim'] = i(Text::class)->rTrim(...);

        $parameters['functions']['lTrim'] = i(Text::class)->lTrim(...);

        $parameters['functions']['fTrim'] = i(Text::class)->fTrim(...);

        $parameters['functions']['mTrim'] = i(Text::class)->mTrim(...);

        $parameters['functions']['cut'] = i(Text::class)->cut(...);

        $parameters['functions']['random'] = i(Text::class)->random(...);

        return new NativeTemplater(...$parameters);
    }
}
