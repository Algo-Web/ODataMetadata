<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Enums;

/**
 * Class EdmTypeKind.
 *
 * Defines EDM metatypes.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Enums
 * @method static self None() Represents a type with an unknown or error kind.
 * @method bool isNone()
 * @method static self Primitive() Represents a type implementing @see IPrimitiveType
 * @method bool isPrimitive()
 * @method static self Entity() Represents a type implementing @see IEntityType
 * @method bool isEntity()
 * @method static self Complex() Represents a type implementing @see IComplexType
 * @method bool isComplex()
 * @method static self Row() Represents a type implementing @see IRowType
 * @method bool isRow()
 * @method static self Collection() Represents a type implementing @see ICollectionType
 * @method bool isCollection()
 * @method static self EntityReference() Represents a type implementing @see IEntityReferenceType
 * @method bool isEntityReference()
 * @method static self Enum() Represents a type implementing @see IEnumType
 * @method bool isEnum()
 */
class TypeKind extends Enum
{
    protected const None            =1;
    protected const Primitive       = 2;
    protected const Entity          = 3;
    protected const Complex         = 4;
    protected const Row             = 5;
    protected const Collection      = 6;
    protected const EntityReference = 7;
    protected const Enum            = 8;

    /**
     *  Returns true if this type kind represents a structured type.
     *
     * @return bool this kind refers to a structured type
     */
    public function IsStructured(): bool
    {
        switch ($this) {
            case TypeKind::Entity():
            case TypeKind::Complex():
            case TypeKind::Row():
                return true;
        }
        return false;
    }
}
