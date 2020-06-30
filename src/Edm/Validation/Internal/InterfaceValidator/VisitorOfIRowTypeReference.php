<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Enums\TypeKind;
use AlgoWeb\ODataMetadata\Interfaces\IRowTypeReference;

class VisitorOfIRowTypeReference extends VisitorOfT
{
    protected function VisitT($typeRef, array &$followup, array &$references): ?iterable
    {
        assert($typeRef instanceof IRowTypeReference);
        return null !== $typeRef->getDefinition() && !$typeRef->getDefinition()->getTypeKind() != TypeKind::Row()
            ? [ InterfaceValidator::CreateTypeRefInterfaceTypeKindValueMismatchError($typeRef) ] : null;
    }

    public function forType(): string
    {
        return IRowTypeReference::class;
    }
}
