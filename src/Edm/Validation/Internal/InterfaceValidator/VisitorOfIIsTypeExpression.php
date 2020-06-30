<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IIsTypeExpression;

class VisitorOfIIsTypeExpression extends VisitorOfT
{
    protected function VisitT($expression, array &$followup, array &$references): ?iterable
    {
        assert($expression instanceof IIsTypeExpression);
        $errors = null;

        if (null !== $expression->getOperand()) {
            $followup[] = $expression->getOperand();
        } else {
            InterfaceValidator::CollectErrors(
                InterfaceValidator::CreatePropertyMustNotBeNullError(
                    $expression,
                    'Operand'
                ),
                $errors
            );
        }

        if (null !== $expression->getType()) {
            // Assert owns its type reference, so it goes as a followup.
            $followup[] = $expression->getType();
        } else {
            InterfaceValidator::CollectErrors(
                InterfaceValidator::CreatePropertyMustNotBeNullError(
                    $expression,
                    'Type'
                ),
                $errors
            );
        }

        return $errors;
    }

    public function forType(): string
    {
        return IIsTypeExpression::class;
    }
}
