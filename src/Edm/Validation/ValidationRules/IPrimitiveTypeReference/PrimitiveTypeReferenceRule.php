<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IPrimitiveTypeReference;

use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRule;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveTypeReference;

abstract class PrimitiveTypeReferenceRule extends ValidationRule
{
    public function getValidatedType(): string
    {
        return IPrimitiveTypeReference::class;
    }
}
