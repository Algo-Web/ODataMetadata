<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Enums\TypeKind;
use AlgoWeb\ODataMetadata\Interfaces\ICollectionType;
use AlgoWeb\ODataMetadata\Interfaces\IComplexType;
use AlgoWeb\ODataMetadata\Interfaces\IEntityReferenceType;
use AlgoWeb\ODataMetadata\Interfaces\IEntityType;
use AlgoWeb\ODataMetadata\Interfaces\IEnumType;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveType;
use AlgoWeb\ODataMetadata\Interfaces\IRowType;
use AlgoWeb\ODataMetadata\Interfaces\IType;

final class VisitorOfIType extends VisitorOfT
{
    protected function VisitT($type, array &$followup, array &$references): ?iterable
    {
        assert($type instanceof IType);
        $typeKindError = null;
        switch ($type->getTypeKind()) {
                    case TypeKind::Primitive():
                        $typeKindError = InterfaceValidator::CheckForInterfaceKindValueMismatchError($type, $type->getTypeKind(), 'TypeKind', IPrimitiveType::class);
                        break;

                    case TypeKind::Entity():
                        $typeKindError = InterfaceValidator::CheckForInterfaceKindValueMismatchError($type, $type->getTypeKind(), 'TypeKind', IEntityType::class);
                        break;

                    case TypeKind::Complex():
                        $typeKindError = InterfaceValidator::CheckForInterfaceKindValueMismatchError($type, $type->getTypeKind(), 'TypeKind', IComplexType::class);
                        break;

                    case TypeKind::Row():
                        $typeKindError = InterfaceValidator::CheckForInterfaceKindValueMismatchError($type, $type->getTypeKind(), 'TypeKind', IRowType::class);
                        break;

                    case TypeKind::Collection():
                        $typeKindError = InterfaceValidator::CheckForInterfaceKindValueMismatchError($type, $type->getTypeKind(), 'TypeKind', ICollectionType::class);
                        break;

                    case TypeKind::EntityReference():
                        $typeKindError = InterfaceValidator::CheckForInterfaceKindValueMismatchError($type, $type->getTypeKind(), 'TypeKind', IEntityReferenceType::class);
                        break;

                    case TypeKind::Enum():
                        $typeKindError = InterfaceValidator::CheckForInterfaceKindValueMismatchError($type, $type->getTypeKind(), 'TypeKind', IEnumType::class);
                        break;

                    case TypeKind::None():
                        break;

                    default:
                        $typeKindError = InterfaceValidator::CreateInterfaceKindValueUnexpectedError($type, $type->getTypeKind()->getKey(), 'TypeKind');
                        break;
                }

        return null !== $typeKindError ? [$typeKindError ] : null;
    }

    public function forType(): string
    {
        return IType::class;
    }
}
