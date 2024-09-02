<?php declare(strict_types=1);

namespace App\Shared;

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
        $parameters = config('common')->get('mailer');

        $parameters['strict'] = $strict;

        return new SimpleMailer(...$parameters);
    }
}
