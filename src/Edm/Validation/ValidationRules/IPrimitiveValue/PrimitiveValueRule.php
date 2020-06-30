<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IPrimitiveValue;

use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRule;
use AlgoWeb\ODataMetadata\Interfaces\Values\IPrimitiveValue;

abstract class PrimitiveValueRule extends ValidationRule
{
    public function getValidatedType(): string
    {
        return IPrimitiveValue::class ;
    }
}
