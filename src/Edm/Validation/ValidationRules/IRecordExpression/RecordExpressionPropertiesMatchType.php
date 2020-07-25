<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IRecordExpression;

use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IRecordExpression;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Util\ExpressionTypeChecker;

/**
 * Validates that if a value record expression declares a type, the property types are correct.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IRecordExpression
 */
class RecordExpressionPropertiesMatchType extends RecordExpressionRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $expression)
    {
        assert($expression instanceof IRecordExpression);
        if (null !== $expression->getDeclaredType() &&
            !$context->checkIsBad($expression) &&
            !$context->checkIsBad($expression->getDeclaredType())) {
            $discoveredErrors = null;
            ExpressionTypeChecker::tryAssertRecordAsType(
                $expression,
                $expression->getDeclaredType(),
                null,
                false,
                $discoveredErrors
            );
            foreach ($discoveredErrors as $error) {
                $context->addRawError($error);
            }
        }
    }
}
