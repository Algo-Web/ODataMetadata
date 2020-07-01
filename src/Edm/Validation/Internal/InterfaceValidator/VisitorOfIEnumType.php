<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\IEnumType;

class VisitorOfIEnumType extends VisitorOfT
{
    protected function VisitT($type, array &$followup, array &$references): ?iterable
    {
        assert($type instanceof IEnumType);
        $errors = [];

        InterfaceValidator::ProcessEnumerable($type, $type->getMembers(), 'Members', $followup, $errors);

        if (null !== $type->getUnderlyingType()) {
            $references[] = $type->getUnderlyingType();
        } else {
            InterfaceValidator::CollectErrors(
                InterfaceValidator::CreatePropertyMustNotBeNullError(
                    $type,
                    'UnderlyingType'
                ),
                $errors
            );
        }

        return $errors;
    }

    public function forType(): string
    {
        return IEnumType::class;
    }
}
