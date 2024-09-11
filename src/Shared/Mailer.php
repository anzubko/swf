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
    public function create(bool $strict = false): SimpleMailer
    {
        $parameters = i(CommonConfig::class)->mailer;

        $parameters['strict'] = $strict;

        return new SimpleMailer(...$parameters);
    }
}
