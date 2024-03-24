<?php declare(strict_types=1);

namespace App\Shared;

use SWF\AbstractShared;
use SWF\TextHandler;

class Text extends AbstractShared
{
    /**
     * To lower case.
     */
    public function lc(?string $string): string
    {
        return TextHandler::lc($string);
    }

    /**
     * First char to lower case.
     */
    public function lcFirst(?string $string): string
    {
        return TextHandler::lcFirst($string);
    }

    /**
     * To upper case.
     */
    public function uc(?string $string): string
    {
        return TextHandler::uc($string);
    }

    /**
     * First char to upper case.
     */
    public function ucFirst(?string $string): string
    {
        return TextHandler::ucFirst($string);
    }

    /**
     * Trim both sides.
     */
    public function trim(?string $string): string
    {
        return TextHandler::trim($string);
    }

    /**
     * Trim right side.
     */
    public function rTrim(?string $string): string
    {
        return TextHandler::rTrim($string);
    }

    /**
     * Trim left side.
     */
    public function lTrim(?string $string): string
    {
        return TextHandler::lTrim($string);
    }

    /**
     * Trim both sides and convert all sequential spaces to one.
     */
    public function fTrim(?string $string, int $limit = 0): string
    {
        return TextHandler::fTrim($string, $limit);
    }

    /**
     * Trim both sides and convert all sequential spaces to one, but leave new lines.
     */
    public function mTrim(?string $string, int $limit = 0): string
    {
        return TextHandler::mTrim($string, $limit);
    }

    /**
     * Cuts string.
     */
    public function cut(?string $string, int $min, ?int $max = null): string
    {
        return TextHandler::cut($string, $min, $max);
    }

    /**
     * Generates random string.
     */
    public function random(int $size = 32, string $chars = '[alpha][digit]'): string
    {
        return TextHandler::random($size, $chars);
    }
}
