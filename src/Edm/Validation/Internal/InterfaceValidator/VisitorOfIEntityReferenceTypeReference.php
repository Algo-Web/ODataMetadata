<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\IEntityReferenceTypeReference;

class VisitorOfIEntityReferenceTypeReference extends VisitorOfT
{
    protected function visitT($typeRef, array &$followup, array &$references): ?iterable
    {
        assert($typeRef instanceof IEntityReferenceTypeReference);
        return (
            null !== $typeRef->getDefinition() &&
            !$typeRef->getDefinition()->getTypeKind()->isEntityReference()
        ) ?
            [InterfaceValidator::createTypeRefInterfaceTypeKindValueMismatchError($typeRef)]
            :
            null;
    }

    public function forType(): string
    {
        return IEntityReferenceTypeReference::class;
    }
}
