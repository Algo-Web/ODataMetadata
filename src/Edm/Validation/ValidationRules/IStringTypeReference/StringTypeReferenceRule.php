<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IStringTypeReference;

use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRule;
use AlgoWeb\ODataMetadata\Interfaces\IStringTypeReference;

abstract class StringTypeReferenceRule extends ValidationRule
{
    public function getValidatedType(): string
    {
        return IStringTypeReference::class;
    }
}
