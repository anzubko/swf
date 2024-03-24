<?php declare(strict_types=1);

namespace App\Shared;

use SWF\AbstractShared;
use SWF\Router\ControllerRouter;

class Router extends AbstractShared
{
    /**
     * Generates URL by action and optional parameters.
     */
    public function genUrl(string $action, string|int|float|null ...$params): string
    {
        return ControllerRouter::getInstance()->genUrl($action, ...$params);
    }

    /**
     * Generates absolute URL by action and optional parameters.
     */
    public function genAbsoluteUrl(string $action, string|int|float|null ...$params): string
    {
        return $this->s(Registry::class)->url . ControllerRouter::getInstance()->genUrl($action, ...$params);
    }
}
