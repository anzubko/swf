<?php
declare(strict_types=1);

namespace App\Shared;

use LogicException;
use SWF\ControllerRouter;

class Router
{
    /**
     * Generates URL by action and optional parameters.
     *
     * @throws LogicException
     */
    public function genUrl(string $action, string|int|float|null ...$params): string
    {
        return ControllerRouter::genUrl($action, ...$params);
    }

    /**
     * Generates absolute URL by action and optional parameters.
     *
     * @throws LogicException
     */
    public function genAbsoluteUrl(string $action, string|int|float|null ...$params): string
    {
        return i(Registry::class)->url . ControllerRouter::genUrl($action, ...$params);
    }
}
