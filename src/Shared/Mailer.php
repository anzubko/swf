<?php declare(strict_types=1);

namespace App\Shared;

use App\Config\CommonConfig;
use InvalidArgumentException;
use SWF\SimpleMailer;

class Mailer
{
    /**
     * Creates new email.
     *
     * @throws InvalidArgumentException
     */
    public function create(): SimpleMailer
    {
        return new SimpleMailer(...i(CommonConfig::class)->mailer);
    }
}
