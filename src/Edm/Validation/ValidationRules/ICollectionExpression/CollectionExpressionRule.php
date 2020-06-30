<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\ICollectionExpression;

use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRule;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\ICollectionExpression;

abstract class CollectionExpressionRule extends ValidationRule
{
    public function getValidatedType(): string
    {
        return ICollectionExpression::class;
    }
}
