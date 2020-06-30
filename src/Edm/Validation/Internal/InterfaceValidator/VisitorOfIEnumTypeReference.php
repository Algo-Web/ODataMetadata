<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\IEnumTypeReference;

class VisitorOfIEnumTypeReference extends VisitorOfT
{
    protected function VisitT($typeRef, array &$followup, array &$references): iterable
    {
        assert($typeRef instanceof IEnumTypeReference);
        return $typeRef->getDefinition() != null && !$typeRef->getDefinition()->getTypeKind()->isEnum() ? [ InterfaceValidator::CreateTypeRefInterfaceTypeKindValueMismatchError($typeRef) ] : null;
    }

    public function forType(): string
    {
        return IEnumTypeReference::class;
    }
}
