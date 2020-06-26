<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IRowType;


use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRule;
use AlgoWeb\ODataMetadata\Interfaces\IRowType;

abstract class RowTypeRule extends ValidationRule
{
    public function getValidatedType(): string
    {
        return IRowType::class;
    }
}