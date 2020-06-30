<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IPropertyValueBinding;

class VisitorOfIPropertyValueBinding extends VisitorOfT
{
    protected function VisitT($binding, array &$followup, array &$references): ?iterable
    {
        assert($binding instanceof IPropertyValueBinding);
        $errors = null;

        if (null !== $binding->getValue()) {
            $followup[] = $binding->getValue();
        } else {
            InterfaceValidator::CollectErrors(
                InterfaceValidator::CreatePropertyMustNotBeNullError(
                    $binding,
                    'Value'
                ),
                $errors
            );
        }

        if (null !== $binding->getBoundProperty()) {
            $references[] = $binding->getBoundProperty();
        } else {
            InterfaceValidator::CollectErrors(
                InterfaceValidator::CreatePropertyMustNotBeNullError(
                    $binding,
                    'BoundProperty'
                ),
                $errors
            );
        }

        return $errors;
    }

    public function forType(): string
    {
        return IPropertyValueBinding::class;
    }
}
