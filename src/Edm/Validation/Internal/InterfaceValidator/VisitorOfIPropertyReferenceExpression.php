<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IPropertyReferenceExpression;

class VisitorOfIPropertyReferenceExpression extends VisitorOfT
{
    protected function VisitT($expression, array &$followup, array &$references): ?iterable
    {
        assert($expression instanceof IPropertyReferenceExpression);
        $errors = [];

        if (null !== $expression->getBase()) {
            $followup[] = $expression->getBase();
        } else {
            InterfaceValidator::CollectErrors(
                InterfaceValidator::CreatePropertyMustNotBeNullError(
                    $expression,
                    'Base'
                ),
                $errors
            );
        }

        // TODO: Whether if condition is always true is ambiguous
        if (null !== $expression->getReferencedProperty()) {
            $references[] = $expression->getReferencedProperty();
        } else {
            InterfaceValidator::CollectErrors(
                InterfaceValidator::CreatePropertyMustNotBeNullError(
                    $expression,
                    'ReferencedProperty'
                ),
                $errors
            );
        }

        return $errors;
    }

    public function forType(): string
    {
        return IPropertyReferenceExpression::class;
    }
}
