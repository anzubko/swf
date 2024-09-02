<?php declare(strict_types=1);

namespace App\Shared;

use SWF\ImprovedCurl;

class Curl
{
    /**
     * @param mixed[] $options
     */
    public function request(array $options, bool $toUtf8 = false): ImprovedCurl
    {
        return new ImprovedCurl($options, $toUtf8);
    }
}
