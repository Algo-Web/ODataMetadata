<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\Values\IStringValue;

class VisitorOfIStringValue extends VisitorOfT
{
    protected function visitT($value, array &$followup, array &$references): ?iterable
    {
        assert($value instanceof IStringValue);
        return null === $value->getValue() ?
            [
                InterfaceValidator::createPropertyMustNotBeNullError($value, 'Value')
            ]
            :
            null;
    }

    public function forType(): string
    {
        return IStringValue::class;
    }
}
