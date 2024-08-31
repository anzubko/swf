<?php declare(strict_types=1);

namespace App\Shared\Template;

use App\Shared\Registry;
use App\Shared\Router;
use App\Shared\Text;
use SWF\AbstractShared;
use SWF\Exception\TemplaterException;
use SWF\TwigTemplater;

/**
 * @mixin TwigTemplater
 */
class Twig extends AbstractShared
{
    /**
     * @throws TemplaterException
     */
    protected static function getInstance(): TwigTemplater
    {
        $parameters = config('template')->get('twig');

        $parameters['debug'] = config('system')->get('debug');

        $parameters['reload'] = 'prod' !== config('system')->get('env');

        $parameters['globals'] = [
            'registry' => shared(Registry::class),
        ];

        $parameters['functions'] = [
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

            'genUrl' => shared(Router::class)->genUrl(...),

            'genAbsoluteUrl' => shared(Router::class)->genAbsoluteUrl(...),
        ];

        return new TwigTemplater(...$parameters);
    }
}
