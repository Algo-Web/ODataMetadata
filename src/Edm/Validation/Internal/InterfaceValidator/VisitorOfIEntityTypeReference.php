<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\IEntityTypeReference;

class VisitorOfIEntityTypeReference extends VisitorOfT
{
    protected function VisitT($typeRef, array &$followup, array &$references): ?iterable
    {
        assert($typeRef instanceof IEntityTypeReference);

        return null !== $typeRef->getDefinition() && !$typeRef->getDefinition()->getTypeKind()->isEntity()
            ? [ InterfaceValidator::CreateTypeRefInterfaceTypeKindValueMismatchError($typeRef) ] : null;
    }

    public function forType(): string
    {
        return IEntityTypeReference::class;
    }
}
