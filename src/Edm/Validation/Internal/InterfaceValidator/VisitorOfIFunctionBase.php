<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;


use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionBase;

class VisitorOfIFunctionBase extends VisitorOfT
{

    protected function VisitT($function, array &$followup, array &$references): iterable
    {
        assert($function instanceof IFunctionBase);
        $errors = null;

        InterfaceValidator::ProcessEnumerable($function, $function->getParameters(), "Parameters", $followup, $errors);

        // Return type is optional for function imports and is required for MDFs. Both cases are derived interfaces (IEdmFunctionImport and IEdmFunction).
        // So, from the point of view of this interface, we consider return type as optional and it is expected that IEdmFunction visitor will have
        // an additional null check for the return type.
        if ($function->getReturnType() != null)
        {
            // Function owns its return type reference, so it goes as a followup.
            $followup[] = $function->getReturnType();
        }

        return $errors;
    }

    public function forType(): string
    {
        return IFunctionBase::class;
    }
}