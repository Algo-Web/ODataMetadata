<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveType;
use AlgoWeb\ODataMetadata\Interfaces\ITemporalTypeReference;

class VisitorOfITemporalTypeReference extends VisitorOfT
{
    protected function visitT($typeRef, array &$followup, array &$references): ?iterable
    {
        assert($typeRef instanceof ITemporalTypeReference);
        $primitive = $typeRef->getDefinition();
        assert($primitive instanceof IPrimitiveType);
        return null !== $typeRef->getDefinition() && !$primitive->getPrimitiveKind()->isTemporal()
            ? [ InterfaceValidator::createTypeRefInterfaceTypeKindValueMismatchError($typeRef) ] : null;
    }

    public function forType(): string
    {
        return ITemporalTypeReference::class;
    }
}
