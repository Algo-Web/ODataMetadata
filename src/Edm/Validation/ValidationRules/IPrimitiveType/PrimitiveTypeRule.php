<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IPrimitiveType;


use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRule;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveType;

abstract class PrimitiveTypeRule extends ValidationRule
{

    public function getValidatedType(): string
    {
        return IPrimitiveType::class;
    }
}