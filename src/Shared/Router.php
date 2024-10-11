<?php
declare(strict_types=1);

namespace App\Shared;

use LogicException;
use RuntimeException;
use SWF\ControllerProvider;

class Router
{
    /**
     * Generates URL by action and optional parameters.
     *
     * @throws LogicException
     * @throws RuntimeException
     */
    public function genUrl(string $action, string|int|float|null ...$params): string
    {
        return i(ControllerProvider::class)->genUrl($action, ...$params);
    }

    /**
     * Generates absolute URL by action and optional parameters.
     *
     * @throws LogicException
     * @throws RuntimeException
     */
    public function genAbsoluteUrl(string $action, string|int|float|null ...$params): string
    {
        return i(Registry::class)->url . i(ControllerProvider::class)->genUrl($action, ...$params);
    }
}
