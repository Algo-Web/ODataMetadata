<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IApplyExpression;

use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRule;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IApplyExpression;

abstract class ApplyExpressionRule extends ValidationRule
{
    public function getValidatedType(): string
    {
        return IApplyExpression::class;
    }
}
