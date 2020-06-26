<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;


use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\IEnumType;

class VisitorOfIEnumType extends VisitorOfT
{

    protected function VisitT($type, array &$followup, array &$references): iterable
    {
        assert($type instanceof IEnumType);
        $errors = null;

        InterfaceValidator::ProcessEnumerable($type, $type->getMembers(), "Members", $followup,  $errors);

        if ($type->getUnderlyingType() != null)
        {
            $references[] = $type->getUnderlyingType();
        }
        else
        {
            InterfaceValidator::CollectErrors(
                InterfaceValidator::CreatePropertyMustNotBeNullError(
                    $type,
                    "UnderlyingType"
                ),
                $errors
            );
        }

        return $errors;
    }

    public function forType(): string
    {
        return IEnumType::class;
    }
}