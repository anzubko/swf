<?php
declare(strict_types=1);

namespace App\Shared;

use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @mixin ValidatorInterface
 */
class Validator
{
    public static function getInstance(): ValidatorInterface
    {
        return Validation::createValidatorBuilder()->enableAttributeMapping()->getValidator();
    }
}
