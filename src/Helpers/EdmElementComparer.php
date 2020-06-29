<?php


namespace AlgoWeb\ODataMetadata\Helpers;


use AlgoWeb\ODataMetadata\Enums\PrimitiveTypeKind;
use AlgoWeb\ODataMetadata\Enums\TypeKind;
use AlgoWeb\ODataMetadata\Exception\InvalidOperationException;
use AlgoWeb\ODataMetadata\Interfaces\IBinaryTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\ICollectionType;
use AlgoWeb\ODataMetadata\Interfaces\IDecimalTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntityReferenceType;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionBase;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionParameter;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveType;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IRowType;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaType;
use AlgoWeb\ODataMetadata\Interfaces\ISpatialTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IStringTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IStructuralProperty;
use AlgoWeb\ODataMetadata\Interfaces\ITemporalTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IType;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
use AlgoWeb\ODataMetadata\StringConst;

abstract class EdmElementComparer
{
    /**
     * Returns true if the compared type is semantically equivalent to this type.
     *
     * @param IEdmElement $thisType Type being compared.
     * @param IEdmElement $otherType Type being compared to.
     * @return bool Equivalence of the two types.
     */
    public static function isEquivalentTo(IEdmElement $thisType, IEdmElement $otherType): bool
    {
        $equivalent = true;
        $interfaces = class_implements($thisType);
        $interfaces = array_filter($interfaces, function ($value) {
            return false !== strpos($value, 'AlgoWeb\\ODataMetadata');
        });
        foreach ($interfaces as $rawInterface) {
            $bitz = explode('\\', $rawInterface);
            $interface = end($bitz);
            $methodName = 'is' . $interface . 'EquivalentTo';
            if (!method_exists(self::class, $methodName)) {
                continue;
            }
            if (!in_array($rawInterface, class_implements($otherType))) {
                return false;
            }
            $equivalent &= self::{$methodName}($thisType, $otherType);
        }
        return $equivalent;
    }

    /**
     * Returns true if the compared type is semantically equivalent to this type.
     * Schema types (ISchemaType) are compared by their object refs.
     *
     * @param IType $thisType Type being compared.
     * @param IType $otherType Type being compared to.
     * @return bool Equivalence of the two types.
     */
    protected static function isITypeEquivalentTo(IType $thisType, IType $otherType): bool
    {
        if ($thisType === $otherType) {
            return true;
        }

        if ($thisType === null || $otherType === null) {
            return false;
        }

        if ($thisType->getTypeKind() != $otherType->getTypeKind()) {
            return false;
        }

        if (!$thisType->getTypeKind()->isAnyOf(
            TypeKind::Primitive(),
            TypeKind::Complex(),
            TypeKind::Entity(),
            TypeKind::Enum(),
            TypeKind::Collection(),
            TypeKind::EntityReference(),
            TypeKind::Row(),
            TypeKind::None()
        )) {
            throw new InvalidOperationException(
                StringConst::UnknownEnumVal_TypeKind($thisType->getTypeKind()->getKey())
            );
        }
        return true;
    }

    protected static function isITypeReferenceEquivalentTo(ITypeReference $thisType, ITypeReference $otherType):bool
    {
        if ($thisType === $otherType) {
            return true;
        }

        if ($thisType === null || $otherType === null) {
            return false;
        }

        $typeKind = $thisType->TypeKind();
        if (!$typeKind->equals($otherType->TypeKind())) {
            return false;
        }

        if (!$typeKind->isPrimitive()) {
            return $thisType->getNullable() === $otherType->getNullable() &&
                self::isEquivalentTo($thisType->getDefinition(), $otherType->getDefinition());
        }
        return true;
    }

    /**
     * Returns true if function signatures are semantically equivalent.
     * Signature includes function name (INamedElement) and its parameter types.
     *
     * @param IFunctionBase $thisFunction Reference to the calling object.
     * @param IFunctionBase $otherFunction Function being compared to.
     * @return bool Equivalence of signatures of the two functions.
     */
    public static function isFunctionSignatureEquivalentTo(IFunctionBase $thisFunction, IFunctionBase $otherFunction): bool
    {
        if ($thisFunction === $otherFunction)
        {
            return true;
        }

        if ($thisFunction->getName() != $otherFunction->getName())
        {
            return false;
        }

        if (!self::isEquivalentTo($thisFunction->getReturnType(), $otherFunction->getReturnType()))
        {
            return false;
        }

        $thisTypeKeys = array_keys($thisFunction->getParameters());
        $otherTypeKeys = array_keys($otherFunction->getParameters());
        $keyCount =  count($thisTypeKeys);
        for($i = 0; $i < $keyCount; ++$i){
            if(
            !self::isEquivalentTo(
                $thisFunction->getParameters()[$thisTypeKeys[$i]],
                $otherFunction->getParameters()[$otherTypeKeys[$i]]
            )
            )
            {
                return false;
            }
        }

        return true;
    }

    /**
     * Returns true if the compared function parameter is semantically equivalent to this function parameter.
     *
     * @param IFunctionParameter $thisParameter Reference to the calling object.
     * @param IFunctionParameter $otherParameter Function parameter being compared to.
     * @return bool Equivalence of the two function parameters.
     */
    protected static function IsIFunctionParameterEquivalentTo(IFunctionParameter $thisParameter, IFunctionParameter $otherParameter): bool
    {
        if ($thisParameter === $otherParameter)
        {
            return true;
        }

        if ($thisParameter === null || $otherParameter === null)
        {
            return false;
        }

        return $thisParameter->getName() == $otherParameter->getName() &&
            $thisParameter->getMode()->equals($otherParameter->getMode()) &&
            self::isEquivalentTo($thisParameter->getType(), $otherParameter->getType());
    }

    protected static function isIPrimitiveTypeEquivalentTo(IPrimitiveType $thisType, IPrimitiveType $otherType): bool
    {
        // OdataMetadata creates one-off instances of primitive type definitions that match by name and kind, but have
        // different object refs. So we can't use object ref comparison here like for other ISchemaType objects.
        return $thisType->getPrimitiveKind() === $otherType->getPrimitiveKind() &&
            $thisType->FullName() === $otherType->FullName();
    }

    protected static function isISchemaTypeEquivalentTo(ISchemaType $thisType, ISchemaType $otherType): bool
    {
        return $thisType === $otherType;
    }

    protected static function isICollectionTypeEquivalentTo(ICollectionType $thisType, ICollectionType $otherType): bool
    {
        return self::isEquivalentTo($thisType->getElementType(), $otherType->getElementType());
    }

    protected static function isIEntityReferenceTypeEquivalentTo(IEntityReferenceType $thisType, IEntityReferenceType $otherType): bool
    {
        return self::isEquivalentTo($thisType->getEntityType(), $otherType->getEntityType());
    }

    protected static function isIRowTypeEquivalentTo(IRowType $thisType, IRowType $otherType): bool
    {
        if (count($thisType->getDeclaredProperties()) != count($otherType->getDeclaredProperties()))
        {
            return false;
        }

        $thisTypeKeys = array_keys($thisType->getDeclaredProperties());
        $otherTypeKeys = array_keys($otherType->getDeclaredProperties());
        $keyCount =  count($thisTypeKeys);
        for($i = 0; $i < $keyCount; ++$i){
            if(
            !self::isEquivalentTo(
                $thisType->getDeclaredProperties()[$thisTypeKeys[$i]],
                $thisType->getDeclaredProperties()[$otherTypeKeys[$i]]
            )
            )
            {
                return false;
            }
        }
        return true;
    }

    protected static function isIStructuralPropertyEquivalentTo(IStructuralProperty $thisProp, IStructuralProperty $otherProp): bool
    {
        if ($thisProp === $otherProp)
        {
            return true;
        }

        if ($thisProp == null || $otherProp == null)
        {
            return false;
        }

        return $thisProp->getName() == $otherProp->getName() &&
            self::isEquivalentTo($thisProp->getType(), $otherProp->getType());
    }


    protected static function isIPrimitiveTypeReferenceEquivalentTo(IPrimitiveTypeReference $thisType, IPrimitiveTypeReference $otherType): bool
    {
        $thisTypePrimitiveKind = $thisType->PrimitiveKind();
        if ($thisTypePrimitiveKind->equals($otherType->PrimitiveKind()))
        {
            return false;
        }

        if(
            $thisTypePrimitiveKind->isAnyOf(
                [
                    PrimitiveTypeKind::Binary(),
                    PrimitiveTypeKind::Decimal(),
                    PrimitiveTypeKind::String(),
                    PrimitiveTypeKind::Time(),
                    PrimitiveTypeKind::DateTime(),
                    PrimitiveTypeKind::DateTimeOffset()
                ]
            ) ||
            $thisTypePrimitiveKind->IsSpatial()){
            return $thisType->getNullable() === $otherType->getNullable() &&
                self::isEquivalentTo($thisType->getDefinition(), $otherType->getDefinition());
        }
        return true;

    }

    protected static function isIBinaryTypeReferenceEquivalentTo(IBinaryTypeReference $thisType, IBinaryTypeReference $otherType): bool
    {
        return $thisType->getNullable() === $otherType->getNullable() &&
            $thisType->isFixedLength() === $otherType->isFixedLength() &&
            $thisType->isUnbounded() === $otherType->isUnbounded() &&
            $thisType->getMaxLength() === $otherType->getMaxLength();
    }

    protected static function isIDecimalTypeReferenceEquivalentTo(IDecimalTypeReference $thisType, IDecimalTypeReference $otherType): bool
    {
        return $thisType->getNullable() === $otherType->getNullable() &&
            $thisType->getPrecision() === $otherType->getPrecision() &&
            $thisType->getScale() === $otherType->getScale();
    }

    protected static function isITemporalTypeReferenceEquivalentTo(ITemporalTypeReference $thisType, ITemporalTypeReference $otherType): bool
    {
        return $thisType->TypeKind()->equals($otherType->TypeKind()) &&
            $thisType->getNullable() == $otherType->getNullable() &&
            $thisType->getPrecision() == $otherType->getPrecision();
    }

    protected static function isIStringTypeReferenceEquivalentTo(IStringTypeReference $thisType, IStringTypeReference $otherType): bool
    {
        return $thisType->getNullable() === $otherType->getNullable() &&
            $thisType->isFixedLength() === $otherType->isFixedLength() &&
            $thisType->isUnbounded() === $otherType->isUnbounded() &&
            $thisType->getMaxLength() === $otherType->getMaxLength() &&
            $thisType->isUnicode() === $otherType->isUnicode() &&
            $thisType->getCollation() === $otherType->getCollation();
    }

    protected static function isISpatialTypeReferenceEquivalentTo(ISpatialTypeReference $thisType, ISpatialTypeReference $otherType): bool
    {
        return $thisType->getNullable() === $otherType->getNullable() &&
            $thisType->getSpatialReferenceIdentifier() === $otherType->getSpatialReferenceIdentifier();
    }
}