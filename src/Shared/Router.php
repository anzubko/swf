<?php declare(strict_types=1);

namespace App\Shared;

use LogicException;
use RuntimeException;
use SWF\AbstractShared;
use SWF\ControllerProvider;

class Router extends AbstractShared
{
    /**
     * Generates URL by action and optional parameters.
     *
     * @throws LogicException
     * @throws RuntimeException
     */
    public function genUrl(string $action, string|int|float|null ...$params): string
    {
        return ControllerProvider::getInstance()->genUrl($action, ...$params);
    }

    /**
     * Generates absolute URL by action and optional parameters.
     *
     * @throws LogicException
     * @throws RuntimeException
     */
    public function genAbsoluteUrl(string $action, string|int|float|null ...$params): string
    {
        return shared(Registry::class)->url . ControllerProvider::getInstance()->genUrl($action, ...$params);
    }
}
