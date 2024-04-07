<?php declare(strict_types=1);

namespace App\Shared\Template;

use App\Shared\Config;
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
        $parameters = $this->s(Config::class)->templateTwig;

        $parameters['debug'] = $this->s(Config::class)->debug;
        $parameters['strict'] = $this->s(Config::class)->strict;
        $parameters['reload'] = 'prod' !== $this->s(Config::class)->env;

        $parameters['globals'] = [
            'registry' => $this->s(Registry::class),
        ];

        $parameters['functions'] = [
            'genUrl' => $this->s(Router::class)->genUrl(...),
            'genAbsoluteUrl' => $this->s(Router::class)->genAbsoluteUrl(...),
            'lc' => $this->s(Text::class)->lc(...),
            'lcFirst' => $this->s(Text::class)->lcFirst(...),
            'uc' => $this->s(Text::class)->uc(...),
            'ucFirst' => $this->s(Text::class)->ucFirst(...),
            'trim' => $this->s(Text::class)->trim(...),
            'rTrim' => $this->s(Text::class)->rTrim(...),
            'lTrim' => $this->s(Text::class)->lTrim(...),
            'fTrim' => $this->s(Text::class)->fTrim(...),
            'mTrim' => $this->s(Text::class)->mTrim(...),
            'cut' => $this->s(Text::class)->cut(...),
            'random' => $this->s(Text::class)->random(...),
        ];

        return new TwigTemplater(...$parameters);
    }
}
