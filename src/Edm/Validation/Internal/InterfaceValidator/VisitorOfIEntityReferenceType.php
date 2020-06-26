<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;


use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\IEntityReferenceType;

final class VisitorOfIEntityReferenceType extends VisitorOfT
{

    protected function VisitT($type, array &$followup, array &$references): iterable
    {
        assert($type instanceof IEntityReferenceType);
        if ($type->getEntityType() != null)
        {
            $references[] = $type->getEntityType();
            return null;
        }
        else
        {
            return [ InterfaceValidator::CreatePropertyMustNotBeNullError($type, "EntityType") ];
        }
    }

    public function forType(): string
    {
        return IEntityReferenceType::class;
    }
}