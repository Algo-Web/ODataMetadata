<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\ICollectionTypeReference;

class VisitorOfICollectionTypeReference extends VisitorOfT
{
    protected function VisitT($typeRef, array &$followup, array &$references): iterable
    {
        assert($typeRef instanceof ICollectionTypeReference);
        return $typeRef->getDefinition() != null &&
        !$typeRef->getDefinition()->getTypeKind()->IsCollection() ?
            [ InterfaceValidator::CreateTypeRefInterfaceTypeKindValueMismatchError($typeRef)]: null;
    }

    public function forType(): string
    {
        return ICollectionTypeReference::class;
    }
}
