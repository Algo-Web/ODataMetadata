<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntitySet;


use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRule;
use AlgoWeb\ODataMetadata\Interfaces\IEntitySet;

abstract class EntitySetRule extends ValidationRule
{
    public function getValidatedType(): string
    {
        return IEntitySet::class;
    }
}