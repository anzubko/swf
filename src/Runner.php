<?php declare(strict_types=1);

namespace App;

use SWF\AbstractRunner;

class Runner extends AbstractRunner
{
    public function __construct()
    {
        parent::__construct(new Config());
    }
}
