<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;


use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\Values\ICollectionValue;

class VisitorOfICollectionValue extends VisitorOfT
{

    protected function VisitT($value, array &$followup, array &$references): iterable
    {
        assert($value instanceof ICollectionValue);
        $errors = null;
        InterfaceValidator::ProcessEnumerable(
            $value,
            $value->getElements(),
            "Elements",
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