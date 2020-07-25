<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\ICollectionType;

class VisitorOfICollectionType extends VisitorOfT
{
    protected function visitT($type, array &$followup, array &$references): ?iterable
    {
        assert($type instanceof ICollectionType);
        if (null !== $type->getElementType()) {
            // Collection owns its element type reference, so it goes as a followup.
            $followup[] = $type->getElementType();
            return null;
        } else {
            return[ InterfaceValidator::createPropertyMustNotBeNullError($type, 'ElementType')];
        }
    }

    public function forType(): string
    {
        return ICollectionType::class;
    }
}
