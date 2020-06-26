<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunctionBase;


use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRule;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionBase;

abstract class FunctionBaseRule extends ValidationRule
{

    public function getValidatedType(): string
    {
        return IFunctionBase::class;
    }
}