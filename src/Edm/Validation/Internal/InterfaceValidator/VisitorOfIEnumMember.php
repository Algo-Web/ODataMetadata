<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\IEnumMember;

class VisitorOfIEnumMember extends VisitorOfT
{
    protected function VisitT($member, array &$followup, array &$references): ?iterable
    {
        assert($member instanceof IEnumMember);
        $errors = [];

        if (null !== $member->getDeclaringType()) {
            $references[] = $member->getDeclaringType();
        } else {
            InterfaceValidator::CollectErrors(
                InterfaceValidator::CreatePropertyMustNotBeNullError(
                    $member,
                    'DeclaringType'
                ),
                $errors
            );
        }

        if (null !== $member->getValue()) {
            $followup[] = $member->getValue();
        } else {
            InterfaceValidator::CollectErrors(
                InterfaceValidator::CreatePropertyMustNotBeNullError(
                    $member,
                    'Value'
                ),
                $errors
            );
        }

        return $errors;
    }

    public function forType(): string
    {
        return IEnumMember::class;
    }
}
