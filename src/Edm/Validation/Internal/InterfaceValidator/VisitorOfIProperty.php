<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Enums\PropertyKind;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\Interfaces\IProperty;
use AlgoWeb\ODataMetadata\Interfaces\IStructuralProperty;

class VisitorOfIProperty extends VisitorOfT
{
    protected function VisitT($property, array &$followup, array &$references): ?iterable
    {
        assert($property instanceof IProperty);
        $errors = [];

        switch ($property->getPropertyKind()) {
            case PropertyKind::Structural():
                InterfaceValidator::CollectErrors(
                    InterfaceValidator::CheckForInterfaceKindValueMismatchError(
                        $property,
                        $property->getPropertyKind(),
                        'PropertyKind',
                        IStructuralProperty::class
                    ),
                    $errors
                );
                break;

            case PropertyKind::Navigation():
                InterfaceValidator::CollectErrors(
                    InterfaceValidator::CheckForInterfaceKindValueMismatchError(
                        $property,
                        $property->getPropertyKind(),
                        'PropertyKind',
                        INavigationProperty::class
                    ),
                    $errors
                );
                break;

            case PropertyKind::None():
                break;

            default:
                InterfaceValidator::CollectErrors(
                    InterfaceValidator::CreateInterfaceKindValueUnexpectedError(
                        $property,
                        $property->getPropertyKind()->getKey(),
                        'PropertyKind'
                    ),
                    $errors
                );
                break;
        }

        if (null !== $property->getType()) {
            // Property owns its type reference, so it goes as a followup.
            $followup[] = $property->getType();
        } else {
            InterfaceValidator::CollectErrors(
                InterfaceValidator::CreatePropertyMustNotBeNullError(
                    $property,
                    'Type'
                ),
                $errors
            );
        }

        if (null !== $property->getDeclaringType()) {
            $references[] = $property->getDeclaringType();
        } else {
            InterfaceValidator::CollectErrors(
                InterfaceValidator::CreatePropertyMustNotBeNullError(
                    $property,
                    'DeclaringType'
                ),
                $errors
            );
        }

        return $errors;
    }

    public function forType(): string
    {
        return IProperty::class;
    }
}
