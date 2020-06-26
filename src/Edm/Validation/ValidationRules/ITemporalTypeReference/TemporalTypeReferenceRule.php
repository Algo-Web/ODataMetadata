<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\ITemporalTypeReference;


use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRule;
use AlgoWeb\ODataMetadata\Interfaces\ITemporalTypeReference;

abstract class TemporalTypeReferenceRule extends ValidationRule
{
    public function getValidatedType(): string
    {
        return ITemporalTypeReference::class;
    }
}