<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INamedElement;


use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRule;
use AlgoWeb\ODataMetadata\Interfaces\INamedElement;

abstract class NamedElementRule  extends ValidationRule
{
    public function getValidatedType(): string
    {
        return INamedElement::class;
    }
}