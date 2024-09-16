<?php declare(strict_types=1);

namespace App;

use App\Config\SystemConfig;
use SWF\AbstractRunner;

class Runner extends AbstractRunner
{
    protected string $systemConfig = SystemConfig::class;
}
