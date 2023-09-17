<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\Values\IPropertyValue;

class VisitorOfIPropertyValue extends VisitorOfT
{
    protected function visitT($value, array &$followup, array &$references): ?iterable
    {
        assert($value instanceof IPropertyValue);
        return null === $value->getName() ?
            [ InterfaceValidator::createPropertyMustNotBeNullError($value, 'Name') ]
            :
            null;
    }

    public function forType(): string
    {
        return IPropertyValue::class;
    }
}
