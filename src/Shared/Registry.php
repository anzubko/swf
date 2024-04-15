<?php declare(strict_types=1);

namespace App\Shared;

use AllowDynamicProperties;
use SWF\AbstractShared;

#[AllowDynamicProperties] class Registry extends AbstractShared
{
    public function __construct()
    {
        $this->url = $_SERVER['USER_URL'];

        $this->requestMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';

        $this->remoteAddr = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';

        $this->routerType = $_SERVER['ROUTER_TYPE'] ?? null;

        $this->routerAction = $_SERVER['ROUTER_ACTION'] ?? null;

        $this->routerAlias = $_SERVER['ROUTER_ALIAS'] ?? null;

        $this->robots = $this->s(Config::class)->robots;

        $this->name = $this->s(Config::class)->name;

        $this->merged = [];
    }
}
