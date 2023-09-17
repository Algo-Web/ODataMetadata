<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\Values\ICollectionValue;

class VisitorOfICollectionValue extends VisitorOfT
{
    protected function visitT($value, array &$followup, array &$references): ?iterable
    {
        assert($value instanceof ICollectionValue);
        $errors = [];
        InterfaceValidator::processEnumerable(
            $value,
            $value->getElements(),
            'Elements',
            $followup,
            $errors
        );
        return $errors;
    }

    public function forType(): string
    {
        return ICollectionValue::class;
    }
}
