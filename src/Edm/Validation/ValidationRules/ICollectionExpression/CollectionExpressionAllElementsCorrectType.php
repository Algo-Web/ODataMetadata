<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\ICollectionExpression;

use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\ICollectionExpression;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Util\ExpressionTypeChecker;

/**
 * Validates that all properties of a collection expression are of the correct type.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\ICollectionExpression
 */
class CollectionExpressionAllElementsCorrectType extends CollectionExpressionRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $expression)
    {
        assert($expression instanceof ICollectionExpression);
        if (null !== $expression->getDeclaredType() &&
            !$context->checkIsBad($expression) &&
            !$context->checkIsBad($expression->getDeclaredType())) {
            $discoveredErrors = null;
            ExpressionTypeChecker::tryAssertCollectionAsType($expression, $expression->getDeclaredType(), null, false, $discoveredErrors);
            foreach ($discoveredErrors as $error) {
                $context->AddRawError($error);
            }
        }
    }
}
