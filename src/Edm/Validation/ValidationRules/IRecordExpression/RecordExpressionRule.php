<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IRecordExpression;


use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRule;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IRecordExpression;

abstract class RecordExpressionRule extends ValidationRule
{

    public function getValidatedType(): string
    {
        return IRecordExpression::class;
    }
}