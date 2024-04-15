<?php declare(strict_types=1);

namespace App\Shared;

use SWF\AbstractShared;
use SWF\ConfigProvider;

class Config extends AbstractShared
{
    /**
     * Gets some value by config name and key.
     */
    public function get(string $configName, string $key, mixed $default = null): mixed
    {
        return ConfigProvider::get($configName, $key, $default);
    }
}
