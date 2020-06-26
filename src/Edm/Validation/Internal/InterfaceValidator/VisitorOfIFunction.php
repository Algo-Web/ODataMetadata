<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;


use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\IFunction;

class VisitorOfIFunction extends VisitorOfT
{

    protected function VisitT($function, array &$followup, array &$references): iterable
    {
        assert($function instanceof IFunction);
        // No need to return the return type as followup - it is handled as such in the IFunctionBase visitor.
        return ($function->getParameters() === null) ? [ InterfaceValidator::CreatePropertyMustNotBeNullError($function, "ReturnType") ] : null;
    }

    public function forType(): string
    {
        return IFunction::class;
    }
}