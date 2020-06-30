<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\RecordExpression\IPropertyConstructor;

class VisitorOfIPropertyConstructor extends VisitorOfT
{
    protected function VisitT($expression, array &$followup, array &$references): iterable
    {
        assert($expression instanceof IPropertyConstructor);
        $errors = null;

        if ($expression->getName() == null) {
            InterfaceValidator::CollectErrors(
                InterfaceValidator::CreatePropertyMustNotBeNullError(
                    $expression,
                    'Name'
                ),
                $errors
            );
        }

        if ($expression->getValue() != null) {
            $followup[] = $expression->getValue();
        } else {
            InterfaceValidator::CollectErrors(
                InterfaceValidator::CreatePropertyMustNotBeNullError(
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
