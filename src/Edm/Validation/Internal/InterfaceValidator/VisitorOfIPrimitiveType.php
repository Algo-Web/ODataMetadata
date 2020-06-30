<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;


use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Enums\PrimitiveTypeKind;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveType;

class VisitorOfIPrimitiveType extends VisitorOfT
{

    protected function VisitT($type, array &$followup, array &$references): iterable
    {
        assert($type instanceof IPrimitiveType);
        // Trying to reduce amount of noise in errors - if this type is bad, then most likely it will have an unacceptable kind, no need to report it.
        if (
            !InterfaceValidator::IsCheckableBad($type) &&
            (
                $type->getPrimitiveKind()->getValue() < PrimitiveTypeKind::None()->getValue() ||
                $type->getPrimitiveKind()->getValue() > PrimitiveTypeKind::GeometryMultiPoint()->getValue()
            )
        )
        {
            return [InterfaceValidator::CreateInterfaceKindValueUnexpectedError($type, $type->getPrimitiveKind()->getKey(), "PrimitiveKind") ];
        }
        else
        {
            return null;
        }
    }

    public function forType(): string
    {
        return IPrimitiveType::class;
    }
}