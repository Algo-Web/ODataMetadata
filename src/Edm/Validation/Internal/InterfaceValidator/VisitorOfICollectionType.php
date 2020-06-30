<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\ICollectionType;

class VisitorOfICollectionType extends VisitorOfT
{
    protected function VisitT($type, array &$followup, array &$references): iterable
    {
        assert($type instanceof ICollectionType);
        if ($type->getElementType() != null) {
            // Collection owns its element type reference, so it goes as a followup.
            $followup[] = $type->getElementType();
            return null;
        } else {
            return[ InterfaceValidator::CreatePropertyMustNotBeNullError($type, 'ElementType')];
        }
    }

    public function forType(): string
    {
        return ICollectionType::class;
    }
}
