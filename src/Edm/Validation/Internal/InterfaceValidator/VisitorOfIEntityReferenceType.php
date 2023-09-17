<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\IEntityReferenceType;

final class VisitorOfIEntityReferenceType extends VisitorOfT
{
    protected function visitT($type, array &$followup, array &$references): ?iterable
    {
        assert($type instanceof IEntityReferenceType);
        if (null !== $type->getEntityType()) {
            $references[] = $type->getEntityType();
            return null;
        } else {
            return [ InterfaceValidator::createPropertyMustNotBeNullError($type, 'EntityType') ];
        }
    }

    public function forType(): string
    {
        return IEntityReferenceType::class;
    }
}
