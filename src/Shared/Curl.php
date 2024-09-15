<?php declare(strict_types=1);

namespace App\Shared;

use SWF\WrappedCurl;

class Curl
{
    /**
     * @param mixed[] $options
     */
    public function request(array $options, bool $toUtf8 = false): WrappedCurl
    {
        return new WrappedCurl($options, $toUtf8);
    }
}
