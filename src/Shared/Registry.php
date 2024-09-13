<?php declare(strict_types=1);

namespace App\Shared;

use AllowDynamicProperties;
use App\Config\CommonConfig;
use stdClass;

#[AllowDynamicProperties]
class Registry extends stdClass
{
    public function __construct()
    {
        $this->url = $_SERVER['USER_URL'];

        $this->requestMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';

        $this->remoteAddr = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';

        $this->actionType = $_SERVER['ACTION_TYPE'] ?? null;

        $this->actionMethod = $_SERVER['ACTION_METHOD'] ?? null;

        $this->actionAlias = $_SERVER['ACTION_ALIAS'] ?? null;

        $this->robots = i(CommonConfig::class)->robots;

        $this->name = i(CommonConfig::class)->name;

        $this->merged = [];
    }
}
