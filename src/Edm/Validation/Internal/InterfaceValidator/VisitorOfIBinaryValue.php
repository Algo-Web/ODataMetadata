<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\Values\IBinaryValue;

class VisitorOfIBinaryValue extends VisitorOfT
{
    protected function VisitT($value, array &$followup, array &$references): ?iterable
    {
        assert($value instanceof IBinaryValue);
        return null !== $value->getValue() ?
            [InterfaceValidator::CreatePropertyMustNotBeNullError($value, 'Value') ]
            :
            null;
    }

    public function forType(): string
    {
        return IBinaryValue::class;
    }
}
