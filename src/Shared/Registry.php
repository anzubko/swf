<?php
declare(strict_types=1);

namespace App\Shared;

use AllowDynamicProperties;
use App\Config\CommonConfig;
use stdClass;

#[AllowDynamicProperties]
class Registry extends stdClass
{
    public function __construct()
    {
        $this->url = (string) ($_SERVER['USER_URL'] ?? $_SERVER['HTTP_URL']);

        $this->userScheme = isset($_SERVER['USER_SCHEME']) ? (string) $_SERVER['USER_SCHEME'] : null;

        $this->userHost = isset($_SERVER['USER_HOST']) ? (string) $_SERVER['USER_HOST'] : null;

        $this->userUrl = isset($_SERVER['USER_URL']) ? (string) $_SERVER['USER_URL'] : null;

        $this->httpScheme = (string) $_SERVER['HTTP_SCHEME'];

        $this->httpHost = (string) $_SERVER['HTTP_HOST'];

        $this->httpUrl = (string) $_SERVER['HTTP_URL'];

        $this->requestTime = (float) $_SERVER['REQUEST_TIME_FLOAT'];

        $this->requestMethod = (string) ($_SERVER['REQUEST_METHOD'] ?? 'GET');

        $this->requestUri = (string) $_SERVER['REQUEST_URI'];

        $this->queryString = (string) $_SERVER['QUERY_STRING'];

        $this->remoteAddr = (string) ($_SERVER['REMOTE_ADDR'] ?? '0.0.0.0');

        $this->actionType = isset($_SERVER['ACTION_TYPE']) ? (string) $_SERVER['ACTION_TYPE'] : null;

        $this->actionMethod = isset($_SERVER['ACTION_METHOD']) ? (string) $_SERVER['ACTION_METHOD'] : null;

        $this->actionAlias = isset($_SERVER['ACTION_ALIAS']) ? (string) $_SERVER['ACTION_ALIAS'] : null;

        $this->robots = i(CommonConfig::class)->robots;

        $this->name = i(CommonConfig::class)->name;

        $this->merged = [];
    }
}
