<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IApplyExpression;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IApplyExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IFunctionReferenceExpression;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\StringConst;
use AlgoWeb\ODataMetadata\Util\ExpressionTypeChecker;

/**
 * Validates the types of a function application are correct.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IApplyExpression
 */
class FunctionApplicationExpressionParametersMatchAppliedFunction extends ApplyExpressionRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $expression)
    {
        assert($expression instanceof IApplyExpression);
        $functionReference = $expression->getAppliedFunction();
        assert($functionReference instanceof IFunctionReferenceExpression);
        if (null !== $functionReference->getReferencedFunction() &&
            !$context->checkIsBad($functionReference->getReferencedFunction())) {
            if (count($functionReference->getReferencedFunction()->getParameters()) != count($expression->getArguments())) {
                EdmUtil::checkArgumentNull($expression->location(), 'expression->Location');
                $context->addError(
                    $expression->location(),
                    EdmErrorCode::IncorrectNumberOfArguments(),
                    StringConst::EdmModel_Validator_Semantic_IncorrectNumberOfArguments(
                        count($expression->getArguments()),
                        $functionReference->getReferencedFunction()->fullName(),
                        count($functionReference->getReferencedFunction()->getParameters())
                    )
                );
            }
            $parameters = $functionReference->getReferencedFunction()->getParameters();
            $arguments  = $expression->getArguments();
            reset($arguments);
            foreach ($parameters as $parameter) {
                $recursiveErrors = [];
                if (!ExpressionTypeChecker::tryAssertType(
                    current($arguments),
                    $parameter->getType(),
                    null,
                    false,
                    $recursiveErrors
                )) {
                    foreach ($recursiveErrors as $error) {
                        $context->addRawError($error);
                    }
                }
                next($arguments);
            }
        }
    }
}
