<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\Values\IDelayedValue;

class VisitorOfIDelayedValue extends VisitorOfT
{
    protected function VisitT($value, array &$followup, array &$references): iterable
    {
        assert($value instanceof IDelayedValue);
        if ($value->getValue() != null) {
            $followup[] = $value->getValue();
            return null;
        } else {
            return [ InterfaceValidator::CreatePropertyMustNotBeNullError($value, 'Value') ];
        }
    }

    public function forType(): string
    {
        return IDelayedValue::class;
    }
}
