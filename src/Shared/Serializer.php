<?php declare(strict_types=1);

namespace App\Shared;

use SWF\AbstractShared;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer as SymfonySerializer;

/**
 * @mixin SymfonySerializer
 */
class Serializer extends AbstractShared
{
    protected static function getInstance(): SymfonySerializer
    {
        return new SymfonySerializer([
            new DateTimeNormalizer(),
            new ArrayDenormalizer(),
            new ObjectNormalizer(
                propertyTypeExtractor: new PropertyInfoExtractor(
                    typeExtractors: [
                        new PhpDocExtractor(),
                    ],
                ),
            ),
        ], [
            new JsonEncoder(),
        ]);
    }
}
