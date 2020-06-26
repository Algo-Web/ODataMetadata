<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IDecimalTypeReference;


use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRule;
use AlgoWeb\ODataMetadata\Interfaces\IDecimalTypeReference;

abstract class DecimalTypeReferenceRule extends ValidationRule
{
    public function getValidatedType(): string
    {
        return IDecimalTypeReference::class;
    }
}