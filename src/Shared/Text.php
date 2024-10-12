<?php
declare(strict_types=1);

namespace App\Shared;

use SWF\TextHandler;

class Text
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
     * Trims both sides.
     */
    public function trim(?string $string): string
    {
        return TextHandler::trim($string);
    }

    /**
     * Trims right side.
     */
    public function rTrim(?string $string): string
    {
        return TextHandler::rTrim($string);
    }

    /**
     * Trims left side.
     */
    public function lTrim(?string $string): string
    {
        return TextHandler::lTrim($string);
    }

    /**
     * Trims both sides and converts all sequential spaces to one.
     */
    public function fTrim(?string $string, int $limit = 0): string
    {
        return TextHandler::fTrim($string, $limit);
    }

    /**
     * Trims both sides and converts all sequential spaces to one, but leave new lines.
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
     * Returns true if string starts from one of the needle strings or false otherwise.
     *
     * @param string[] $needles
     */
    public function startsWith(string $string, array $needles): bool
    {
        return TextHandler::startsWith($string, $needles);
    }

    /**
     * Returns true if string ends with one of the needle strings or false otherwise.
     *
     * @param string[] $needles
     */
    public function endsWith(string $string, array $needles): bool
    {
        return TextHandler::endsWith($string, $needles);
    }

    /**
     * Returns true if string contains one of the needle strings or false otherwise.
     *
     * @param string[] $needles
     */
    public function contains(string $string, array $needles): bool
    {
        return TextHandler::contains($string, $needles);
    }

    /**
     * Generates random string.
     */
    public function random(int $size = 32, string $chars = '[alpha][digit]'): string
    {
        return TextHandler::random($size, $chars);
    }
}
