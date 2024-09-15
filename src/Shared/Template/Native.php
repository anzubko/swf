<?php declare(strict_types=1);

namespace App\Shared\Template;

use App\Config\SystemConfig;
use App\Config\TemplateConfig;
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
        $parameters = i(TemplateConfig::class)->native;

        $parameters['debug'] = i(SystemConfig::class)->debug;

        $parameters['globals'] = [
            'registry' => i(Registry::class),
        ];

        $parameters['functions'] = [
            'genUrl' => i(Router::class)->genUrl(...),
            'genAbsoluteUrl' => i(Router::class)->genAbsoluteUrl(...),
            'lc' => i(Text::class)->lc(...),
            'lcFirst' => i(Text::class)->lcFirst(...),
            'uc' => i(Text::class)->uc(...),
            'ucFirst' => i(Text::class)->ucFirst(...),
            'trim' => i(Text::class)->trim(...),
            'rTrim' => i(Text::class)->rTrim(...),
            'lTrim' => i(Text::class)->lTrim(...),
            'fTrim' => i(Text::class)->fTrim(...),
            'mTrim' => i(Text::class)->mTrim(...),
            'cut' => i(Text::class)->cut(...),
            'random' => i(Text::class)->random(...),
        ];

        return new NativeTemplater(...$parameters);
    }
}
