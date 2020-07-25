<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\Values\IEnumValue;

class VisitorOfIEnumValue extends VisitorOfT
{
    protected function VisitT($value, array &$followup, array &$references): ?iterable
    {
        assert($value instanceof IEnumValue);
        $followup[] = $value->getValue();
        return null;
    }

    public function forType(): string
    {
        return IEnumValue::class;
    }
}
