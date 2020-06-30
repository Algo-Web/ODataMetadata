<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\Values\IStructuredValue;

class VisitorOfIStructuredValue extends VisitorOfT
{
    protected function VisitT($value, array &$followup, array &$references): iterable
    {
        assert($value instanceof IStructuredValue);
        $errors = null;
        InterfaceValidator::ProcessEnumerable(
            $value,
            $value->getPropertyValues(),
            'PropertyValues',
            $followup,
            $errors
        );
        return $errors;
    }

    public function forType(): string
    {
        return IStructuredValue::class;
    }
}
