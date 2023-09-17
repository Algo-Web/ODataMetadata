<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IIfExpression;

use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IIfExpression;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Library\Core\EdmCoreModel;
use AlgoWeb\ODataMetadata\Util\ExpressionTypeChecker;

/**
 * Validates that an if expression has a boolean condition.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IIfExpression
 */
class IfExpressionAssertCorrectTestType extends IfExpressionRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $expression)
    {
        assert($expression instanceof IIfExpression);

        $errors = [];
        if (!ExpressionTypeChecker::tryAssertType(
            $expression->getTestExpression(),
            EdmCoreModel::getInstance()->getBoolean(false),
            null,
            false,
            $errors
        )) {
            foreach ($errors as $error) {
                $context->addRawError($error);
            }
        }
    }
}
