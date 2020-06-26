<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;


use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\Values\IPropertyValue;

class VisitorOfIPropertyValue extends VisitorOfT
{

    protected function VisitT($value, array &$followup, array &$references): iterable
    {
        assert($value instanceof IPropertyValue);
        return $value->getName() == null ?
            [ InterfaceValidator::CreatePropertyMustNotBeNullError($value, "Name") ]
            :
            null;

    }

    public function forType(): string
    {
        return IPropertyValue::class;
    }
}