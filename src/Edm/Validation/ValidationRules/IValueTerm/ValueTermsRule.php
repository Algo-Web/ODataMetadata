<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IValueTerm;


use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRule;
use AlgoWeb\ODataMetadata\Interfaces\IValueTerm;

abstract class ValueTermsRule extends ValidationRule
{

    public function getValidatedType(): string
    {
        return IValueTerm::class;
    }
}