<?php declare(strict_types=1);

namespace App\Shared;

use InvalidArgumentException;
use SWF\AbstractShared;
use SWF\SimpleMailer;

class Mailer extends AbstractShared
{
    /**
     * Creates new email.
     *
     * @throws InvalidArgumentException
     */
    public function create(bool $strict = false): SimpleMailer
    {
        $parameters = $this->s(Config::class)->mailer + [
            'strict' => $strict,
        ];

        return new SimpleMailer(...$parameters);
    }
}
