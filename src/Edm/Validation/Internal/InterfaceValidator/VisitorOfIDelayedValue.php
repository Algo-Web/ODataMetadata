<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\Values\IDelayedValue;

class VisitorOfIDelayedValue extends VisitorOfT
{
    protected function visitT($value, array &$followup, array &$references): ?iterable
    {
        assert($value instanceof IDelayedValue);
        if (null !== $value->getValue()) {
            $followup[] = $value->getValue();
            return null;
        } else {
            return [ InterfaceValidator::createPropertyMustNotBeNullError($value, 'Value') ];
        }
    }

    public function forType(): string
    {
        return IDelayedValue::class;
    }
}
