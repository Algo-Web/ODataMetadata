<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;


use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\IBinaryTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveType;

class VisitorOfIBinaryTypeReference extends VisitorOfT
{

    protected function VisitT($typeRef, array &$followup, array &$references): iterable
    {
        assert($typeRef instanceof IBinaryTypeReference);
        $primitive = $typeRef->getDefinition();
        assert($primitive instanceof IPrimitiveType);
        return $typeRef->getDefinition() != null && !$primitive->getPrimitiveKind()->isBinary() ? [ InterfaceValidator::CreateTypeRefInterfaceTypeKindValueMismatchError($typeRef) ] : null;
    }

    public function forType(): string
    {
        return IBinaryTypeReference::class;
    }
}