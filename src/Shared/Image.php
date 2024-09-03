<?php declare(strict_types=1);

namespace App\Shared;

use GdImage;
use SWF\ImageHandler;

class Image
{
    /**
     * Reads image from string.
     */
    public function fromString(string|false|null $string): ?GdImage
    {
        return ImageHandler::fromString($string);
    }

    /**
     * Reads image from file.
     */
    public function fromFile(string $file): ?GdImage
    {
        return ImageHandler::fromFile($file);
    }

    /**
     * Saves as PNG to file or returns as string.
     */
    public function savePng(GdImage $image, ?string $file = null, int $quality = 0): string|bool
    {
        return ImageHandler::savePng($image, $file, $quality);
    }

    /**
     * Saves as JPEG to file or returns as string.
     */
    public function saveJpeg(GdImage $image, ?string $file = null, int $quality = 80): string|bool
    {
        return ImageHandler::saveJpeg($image, $file, $quality);
    }

    /**
     * Resizes image.
     */
    public function resize(GdImage $image, int $nW, int $nH, bool $crop = false, bool $fit = false): GdImage
    {
        return ImageHandler::resize($image, $nW, $nH, $crop, $fit);
    }
}
