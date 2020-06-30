<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IApplyExpression;

/**
 * Visitor Of Function Application Expression.
 * @package AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator
 */
class VisitorOfIApplyExpression extends VisitorOfT
{
    protected function VisitT($expression, array &$followup, array &$references): iterable
    {
        assert($expression instanceof IApplyExpression);
        $errors = null;

        if ($expression->getAppliedFunction() != null) {
            $followup[] = $expression->getAppliedFunction();
        } else {
            InterfaceValidator::CollectErrors(
                InterfaceValidator::CreatePropertyMustNotBeNullError(
                    $expression,
                    'AppliedFunction'
                ),
                $errors
            );
        }

        InterfaceValidator::ProcessEnumerable(
            $expression,
            $expression->getArguments(),
            'Arguments',
            $followup,
            $errors
        );

        return $errors;
    }

    public function forType(): string
    {
        return IApplyExpression::class;
    }
}
