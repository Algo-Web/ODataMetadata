<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Enums\ConcurrencyMode;
use AlgoWeb\ODataMetadata\Interfaces\IStructuralProperty;

class VisitorOfIStructuralProperty extends VisitorOfT
{
    protected function visitT($property, array &$followup, array &$references): ?iterable
    {
        assert($property instanceof IStructuralProperty);
        if ($property->getConcurrencyMode()->getValue() < ConcurrencyMode::None()->getValue() ||
            $property->getConcurrencyMode() > ConcurrencyMode::Fixed()->getValue()) {
            return [
                InterfaceValidator::createEnumPropertyOutOfRangeError(
                    $property,
                    $property->getConcurrencyMode(),
                    'ConcurrencyMode'
                )
            ];
        } else {
            return null;
        }
    }

    public function forType(): string
    {
        return IStructuralProperty::class;
    }
}
