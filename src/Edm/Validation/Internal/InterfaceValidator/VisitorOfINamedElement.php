<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\INamedElement;

final class VisitorOfINamedElement extends VisitorOfT
{
    protected function VisitT($item, array &$followup, array &$references): iterable
    {
        assert($item instanceof INamedElement);
        return $item->getName() != null ? null : [ InterfaceValidator::CreatePropertyMustNotBeNullError($item, 'Name') ];
    }

    public function forType(): string
    {
        return INamedElement::class;
    }
}
