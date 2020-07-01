<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IIfExpression;

class VisitorOfIIfExpression extends VisitorOfT
{
    protected function VisitT($expression, array &$followup, array &$references): ?iterable
    {
        assert($expression instanceof IIfExpression);
        $errors = [];

        if (null !== $expression->getTestExpression()) {
            $followup[] = $expression->getTestExpression();
        } else {
            InterfaceValidator::CollectErrors(
                InterfaceValidator::CreatePropertyMustNotBeNullError(
                    $expression,
                    'TestExpression'
                ),
                $errors
            );
        }

        if (null !== $expression->getTrueExpression()) {
            $followup[] = $expression->getTrueExpression();
        } else {
            InterfaceValidator::CollectErrors(
                InterfaceValidator::CreatePropertyMustNotBeNullError(
                    $expression,
                    'TrueExpression'
                ),
                $errors
            );
        }

        if (null !== $expression->getFalseExpression()) {
            $followup[] = $expression->getFalseExpression();
        } else {
            InterfaceValidator::CollectErrors(
                InterfaceValidator::CreatePropertyMustNotBeNullError(
                    $expression,
                    'FalseExpression'
                ),
                $errors
            );
        }

        return $errors;
    }

    public function forType(): string
    {
        return IIfExpression::class;
    }
}
