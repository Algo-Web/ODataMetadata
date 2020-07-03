<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;
use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Enums\OnDeleteAction;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\StringConst;

class VisitorOfINavigationProperty extends VisitorOfT
{
    protected function VisitT($property, array &$followup, array &$references): ?iterable
    {
        assert($property instanceof INavigationProperty);
        $errors = [];

        if (null !== $property->getPartner()) {
            // If the declaring type of the partner does not contain the partner, it is a silent partner, and belongs
            // to this property.
            $prop = $property->getPartner()->getDeclaringType()->getDeclaredProperties();
            if (!in_array($property->getPartner(), $prop)) {
                $followup[] = $property->getPartner();
            } else {
                $references[] =$property->getPartner();
            }

            if ($property->getPartner()->getPartner() !== $property || $property->getPartner() === $property) {
                InterfaceValidator::CollectErrors(
                    new EdmError(
                        InterfaceValidator::GetLocation($property),
                        EdmErrorCode::InterfaceCriticalNavigationPartnerInvalid(),
                        StringConst::EdmModel_Validator_Syntactic_NavigationPartnerInvalid($property->getName())
                    ),
                    $errors
                );
            }
        } else {
            InterfaceValidator::CollectErrors(
                InterfaceValidator::CreatePropertyMustNotBeNullError(
                    $property,
                    'Partner'
                ),
                $errors
            );
        }

        if (null !== $property->getDependentProperties()) {
            InterfaceValidator::ProcessEnumerable(
                $property,
                $property->getDependentProperties(),
                'DependentProperties',
                $references,
                $errors
            );
        }

        if ($property->getOnDelete()->getValue() < OnDeleteAction::None()->getValue() ||
                    $property->getOnDelete() > OnDeleteAction::Cascade()->getValue()) {
            InterfaceValidator::CollectErrors(
                InterfaceValidator::CreateEnumPropertyOutOfRangeError(
                    $property,
                    $property->getOnDelete(),
                    'OnDelete'
                ),
                $errors
            );
        }

        return $errors;
    }

    public function forType(): string
    {
        return INavigationProperty::class;
    }
}
