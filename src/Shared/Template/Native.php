<?php declare(strict_types=1);

namespace App\Shared\Template;

use App\Shared\Registry;
use App\Shared\Router;
use App\Shared\Text;
use SWF\AbstractShared;
use SWF\Interface\TemplaterInterface;
use SWF\NativeTemplater;

/**
 * @mixin TemplaterInterface
 */
class Native extends AbstractShared
{
    protected static function getInstance(): TemplaterInterface
    {
        $parameters = config('template')->get('native');

        $parameters['debug'] = config('system')->get('debug');

        $parameters['globals'] = [
            'registry' => shared(Registry::class),
        ];

        $parameters['functions'] = [
            'genUrl' => shared(Router::class)->genUrl(...),

            'genAbsoluteUrl' => shared(Router::class)->genAbsoluteUrl(...),

            'lc' => shared(Text::class)->lc(...),

            'lcFirst' => shared(Text::class)->lcFirst(...),

            'uc' => shared(Text::class)->uc(...),

            'ucFirst' => shared(Text::class)->ucFirst(...),

            'trim' => shared(Text::class)->trim(...),

            'rTrim' => shared(Text::class)->rTrim(...),

            'lTrim' => shared(Text::class)->lTrim(...),

            'fTrim' => shared(Text::class)->fTrim(...),

            'mTrim' => shared(Text::class)->mTrim(...),

            'cut' => shared(Text::class)->cut(...),

            'random' => shared(Text::class)->random(...),
        ];

        return new NativeTemplater(...$parameters);
    }
}
