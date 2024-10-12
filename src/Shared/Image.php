<?php
declare(strict_types=1);

namespace App\Shared;

use GdImage;
use SWF\ImageHandler;

class Image
{
    /**
     * Reads image from string.
     */
    public function fromString(string $string): ?GdImage
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
     * Transform image to PNG.
     */
    public function toPng(GdImage $image, int $quality = 0): ?string
    {
        return ImageHandler::toPng($image, $quality);
    }

    /**
     * Saves as PNG.
     *
     * @param resource|string $file
     */
    public function savePng(GdImage $image, mixed $file, int $quality = 0): bool
    {
        return ImageHandler::savePng($image, $file, $quality);
    }

    /**
     * Transform image to JPEG.
     */
    public function toJpg(GdImage $image, int $quality = 100): ?string
    {
        return ImageHandler::toJpg($image, $quality);
    }

    /**
     * Saves as JPEG.
     *
     * @param resource|string $file
     */
    public function saveJpeg(GdImage $image, mixed $file, int $quality = 100): bool
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
