<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\ICollectionTypeReference;

class VisitorOfICollectionTypeReference extends VisitorOfT
{
    protected function visitT($typeRef, array &$followup, array &$references): ?iterable
    {
        assert($typeRef instanceof ICollectionTypeReference);
        return null !== $typeRef->getDefinition() &&
               !$typeRef->getDefinition()->getTypeKind()->isCollection() ?
            [ InterfaceValidator::createTypeRefInterfaceTypeKindValueMismatchError($typeRef)]: null;
    }

    public function forType(): string
    {
        return ICollectionTypeReference::class;
    }
}
