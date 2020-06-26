<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;


use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\Values\IBinaryValue;

class VisitorOfIBinaryValue extends VisitorOfT
{

    protected function VisitT($value, array &$followup, array &$references): iterable
    {
        assert($value instanceof IBinaryValue);
        return $value->getValue() == null ?
            [InterfaceValidator::CreatePropertyMustNotBeNullError($value, "Value") ]
            :
            null;
    }

    public function forType(): string
    {
        return IBinaryValue::class;
    }
}