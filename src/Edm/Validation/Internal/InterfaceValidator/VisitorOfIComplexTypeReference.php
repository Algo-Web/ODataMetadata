<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\IComplexTypeReference;

class VisitorOfIComplexTypeReference extends VisitorOfT
{
    protected function VisitT($typeRef, array &$followup, array &$references): ?iterable
    {
        assert($typeRef instanceof IComplexTypeReference);
        return null !== $typeRef->getDefinition() && !$typeRef->getDefinition()->getTypeKind()->isComplex()
            ? [ InterfaceValidator::CreateTypeRefInterfaceTypeKindValueMismatchError($typeRef) ] : null;
    }

    public function forType(): string
    {
        return IComplexTypeReference::class;
    }
}
