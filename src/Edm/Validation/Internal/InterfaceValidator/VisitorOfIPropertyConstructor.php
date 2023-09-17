<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\RecordExpression\IPropertyConstructor;

class VisitorOfIPropertyConstructor extends VisitorOfT
{
    protected function visitT($expression, array &$followup, array &$references): ?iterable
    {
        assert($expression instanceof IPropertyConstructor);
        $errors = [];

        if (null === $expression->getName()) {
            InterfaceValidator::collectErrors(
                InterfaceValidator::createPropertyMustNotBeNullError(
                    $expression,
                    'Name'
                ),
                $errors
            );
        }

        if (null !== $expression->getValue()) {
            $followup[] = $expression->getValue();
        } else {
            InterfaceValidator::collectErrors(
                InterfaceValidator::createPropertyMustNotBeNullError(
                    $expression,
                    'Value'
                ),
                $errors
            );
        }

        return $errors;
    }

    public function forType(): string
    {
        return IPropertyConstructor::class;
    }
}
