<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\IEnumTypeReference;

class VisitorOfIEnumTypeReference extends VisitorOfT
{
    protected function visitT($typeRef, array &$followup, array &$references): ?iterable
    {
        assert($typeRef instanceof IEnumTypeReference);
        return null !== $typeRef->getDefinition() && !$typeRef->getDefinition()->getTypeKind()->isEnum()
            ? [ InterfaceValidator::createTypeRefInterfaceTypeKindValueMismatchError($typeRef) ] : null;
    }

    public function forType(): string
    {
        return IEnumTypeReference::class;
    }
}
