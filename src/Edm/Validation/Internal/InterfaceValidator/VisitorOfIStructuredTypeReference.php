<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;


use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredTypeReference;

class VisitorOfIStructuredTypeReference extends VisitorOfT
{

    protected function VisitT($typeRef, array &$followup, array &$references): iterable
    {
        assert($typeRef instanceof IStructuredTypeReference);
        return $typeRef->getDefinition() != null && !$typeRef->getDefinition()->getTypeKind()->IsStructured() ? [ InterfaceValidator::CreateTypeRefInterfaceTypeKindValueMismatchError($typeRef) ] : null;
    }

    public function forType(): string
    {
        return IStructuredTypeReference::class;
    }
}