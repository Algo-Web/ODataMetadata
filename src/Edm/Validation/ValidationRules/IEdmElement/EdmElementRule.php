<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEdmElement;


use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRule;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;

abstract class EdmElementRule extends ValidationRule
{

    public function getValidatedType(): string
    {
        return IEdmElement::class;
    }

}