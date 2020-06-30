<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IComplexType;

use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRule;
use AlgoWeb\ODataMetadata\Interfaces\IComplexType;

abstract class ComplexTypeRule extends ValidationRule
{
    public function getValidatedType(): string
    {
        return IComplexType::class;
    }
}
