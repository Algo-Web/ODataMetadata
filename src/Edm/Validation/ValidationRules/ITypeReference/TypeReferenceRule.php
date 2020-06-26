<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\ITypeReference;


use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRule;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;

abstract class TypeReferenceRule extends ValidationRule
{
    public function getValidatedType(): string
    {
         return ITypeReference::class;
    }
}