<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\IEntityReferenceTypeReference;

class VisitorOfIEntityReferenceTypeReference extends VisitorOfT
{
    protected function VisitT($typeRef, array &$followup, array &$references): iterable
    {
        assert($typeRef instanceof IEntityReferenceTypeReference);
        return (
            $typeRef->getDefinition() != null &&
            !$typeRef->getDefinition()->getTypeKind()->isEntityReference()
        ) ?
            [InterfaceValidator::CreateTypeRefInterfaceTypeKindValueMismatchError($typeRef)]
            :
            null;
    }

    public function forType(): string
    {
        return IEntityReferenceTypeReference::class;
    }
}
