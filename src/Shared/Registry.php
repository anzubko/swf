<?php declare(strict_types=1);

namespace App\Shared;

use AllowDynamicProperties;
use stdClass;

#[AllowDynamicProperties]
class Registry extends stdClass
{
    public function __construct()
    {
        $this->url = $_SERVER['USER_URL'];

        $this->requestMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';

        $this->remoteAddr = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';

        $this->routerType = $_SERVER['ROUTER_TYPE'] ?? null;

        $this->routerAction = $_SERVER['ROUTER_ACTION'] ?? null;

        $this->routerAlias = $_SERVER['ROUTER_ALIAS'] ?? null;

        $this->robots = config('common')->get('robots');

        $this->name = config('common')->get('name');

        $this->merged = [];
    }
}
