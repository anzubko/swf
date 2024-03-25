<?php declare(strict_types=1);

namespace App\Shared;

use AllowDynamicProperties;
use SWF\AbstractShared;

#[AllowDynamicProperties] class Registry extends AbstractShared
{
    public function __construct()
    {
        $this->url = (string) $_SERVER['USER_URL'];

        $this->requestMethod = (string) ($_SERVER['REQUEST_METHOD'] ?? 'GET');

        $this->remoteAddr = (string) ($_SERVER['REMOTE_ADDR'] ?? '0.0.0.0');

        $this->routerType = (string) ($_SERVER['ROUTER_TYPE'] ?? '');

        $this->routerAction = (string) ($_SERVER['ROUTER_ACTION'] ?? '');

        $this->routerAlias = (string) ($_SERVER['ROUTER_ALIAS'] ?? '');

        $this->robots = $this->s(Config::class)->robots;

        $this->name = $this->s(Config::class)->name;

        $this->merged = [];
    }
}
