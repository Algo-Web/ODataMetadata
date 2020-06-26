<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;


use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveTypeReference;

class VisitorOfIPrimitiveTypeReference extends VisitorOfT
{
    protected function VisitT($typeRef, array &$followup, array &$references): iterable
    {
        assert($typeRef instanceof IPrimitiveTypeReference);
        return $typeRef->getDefinition() != null && !$typeRef->getDefinition()->getTypeKind()->isPrimitive() ? [ InterfaceValidator::CreateTypeRefInterfaceTypeKindValueMismatchError($typeRef) ] : null;
    }

    public function forType(): string
    {
        return IPrimitiveTypeReference::class;
    }
}