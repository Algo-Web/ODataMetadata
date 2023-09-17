<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IStructuralProperty;

use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRule;
use AlgoWeb\ODataMetadata\Interfaces\IStructuralProperty;

abstract class StructuralPropertyRule extends ValidationRule
{
    public function getValidatedType(): string
    {
        return IStructuralProperty::class;
    }
}
