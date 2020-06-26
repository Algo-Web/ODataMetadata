<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IIfExpression;


use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRule;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IIfExpression;

abstract class IfExpressionRule extends ValidationRule
{

    public function getValidatedType(): string
    {
        return IIfExpression::class;
    }
}