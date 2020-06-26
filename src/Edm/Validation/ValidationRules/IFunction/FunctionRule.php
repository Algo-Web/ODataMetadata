<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunction;


use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRule;
use AlgoWeb\ODataMetadata\Interfaces\IFunction;

abstract class FunctionRule extends ValidationRule
{
    public function getValidatedType(): string
    {
        return IFunction::class;
    }
}