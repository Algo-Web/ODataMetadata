<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IStructuredType;

use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRule;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredType;

abstract class StructuredTypeRule extends ValidationRule
{
    public function getValidatedType(): string
    {
        return IStructuredType::class;
    }
}
