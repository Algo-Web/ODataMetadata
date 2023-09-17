<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveType;
use AlgoWeb\ODataMetadata\Interfaces\ISpatialTypeReference;

class VisitorOfISpatialTypeReference extends VisitorOfT
{
    protected function VisitT($typeRef, array &$followup, array &$references): iterable
    {
        assert($typeRef instanceof ISpatialTypeReference);
        $primitive = $typeRef->getDefinition();
        assert($primitive instanceof IPrimitiveType);
        return $typeRef->getDefinition() != null && !$primitive->getPrimitiveKind()->IsSpatial() ? [ InterfaceValidator::CreateTypeRefInterfaceTypeKindValueMismatchError($typeRef) ] : null;
    }

    public function forType(): string
    {
        return ISpatialTypeReference::class;
    }
}
