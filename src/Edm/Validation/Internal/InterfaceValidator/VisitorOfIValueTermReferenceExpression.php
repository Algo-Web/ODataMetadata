<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IValueTermReferenceExpression;

class VisitorOfIValueTermReferenceExpression extends VisitorOfT
{
    protected function visitT($expression, array &$followup, array &$references): ?iterable
    {
        assert($expression instanceof IValueTermReferenceExpression);
        $errors = [];

        // TODO: Ambiguous whether this is actually always non-null
        if (null !== $expression->getBase()) {
            $followup[] = $expression->getBase();
        } else {
            InterfaceValidator::collectErrors(
                InterfaceValidator::createPropertyMustNotBeNullError(
                    $expression,
                    'Base'
                ),
                $errors
            );
        }

        // TODO: Ambiguous whether this is actually always non-null
        if (null !== $expression->getTerm()) {
            $references[] = $expression->getTerm();
        } else {
            InterfaceValidator::collectErrors(
                InterfaceValidator::createPropertyMustNotBeNullError(
                    $expression,
                    'Term'
                ),
                $errors
            );
        }

        return $errors;
    }

    public function forType(): string
    {
        return IValueTermReferenceExpression::class;
    }
}
