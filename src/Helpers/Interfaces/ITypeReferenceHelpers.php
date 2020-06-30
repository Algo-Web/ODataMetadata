<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Helpers\Interfaces;

use AlgoWeb\ODataMetadata\Enums\PrimitiveTypeKind;
use AlgoWeb\ODataMetadata\Enums\TypeKind;
use AlgoWeb\ODataMetadata\Interfaces\IBinaryTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\ICollectionTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IComplexTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IDecimalTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IEntityReferenceTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IEntityTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IEnumTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IRowTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\ISpatialTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IStringTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\ITemporalTypeReference;

/**
 * Class TypeReferenceHelpers.
 * @package AlgoWeb\ODataMetadata\Helpers
 */
interface ITypeReferenceHelpers
{
    /**
     * Gets the type kind of the type references definition.
     *
     * @return TypeKind the type kind of the reference
     */
    public function TypeKind(): TypeKind;

    /**
     * Gets the full name of the definition referred to by the type reference.
     *
     * @return string|null the full name of this references definition
     */
    public function FullName(): ?string;

    /**
     * Returns the primitive kind of the definition of this reference.
     *
     * @return PrimitiveTypeKind the primitive kind of the definition of this reference
     */
    public function PrimitiveKind(): PrimitiveTypeKind;

    /**
     * Returns true if this reference refers to a collection.
     *
     * @return bool this reference refers to a collection
     */
    public function IsCollection(): bool;

    /**
     * Returns true if this reference refers to an entity type.
     *
     * @return bool this reference refers to an entity type
     */
    public function IsEntity(): bool;

    /**
     * Returns true if this reference refers to an entity type.
     *
     * @return bool This reference refers to an entity type.<
     */
    public function IsEntityReference(): bool;

    /**
     * Returns true if this reference refers to a complex type.
     *
     * @return bool this reference refers to a complex type
     */
    public function IsComplex(): bool;

    /**
     * Returns true if this reference refers to an enumeration type.
     *
     * @return bool this reference refers to an enumeration type
     */
    public function IsEnum(): bool;

    /**
     * Returns true if this reference refers to a row type.
     *
     * @return bool this reference refers to a row type
     */
    public function IsRow(): bool;

    /**
     * Returns true if this reference refers to a structured type.
     *
     * @return bool this reference refers to a structured type
     */
    public function IsStructured(): bool;

    /**
     * Returns true if this reference refers to a primitive type.
     *
     * @return bool this reference refers to a primitive type
     */
    public function IsPrimitive(): bool;

    /**
     * Returns true if this reference refers to a binary type.
     *
     * @return bool this reference refers to a binary type
     */
    public function IsBinary(): bool;

    /**
     * Returns true if this reference refers to a boolean type.
     *
     * @return bool this reference refers to a boolean type
     */
    public function IsBoolean(): bool;

    /**
     * Returns true if this reference refers to a temporal type.
     *
     * @return bool this reference refers to a temporal type
     */
    public function IsTemporal(): bool;

    /**
     * Returns true if this reference refers to a DateTime type.
     *
     * @return bool this reference refers to a DateTime type
     */
    public function IsDateTime(): bool;

    /**
     * Returns true if this reference refers to a time type.
     *
     * @return bool this reference refers to a time type
     */
    public function IsTime(): bool;

    /**
     * Returns true if this reference refers to a DateTimeOffset type.
     *
     * @return bool this reference refers to a DateTimeOffset type
     */
    public function IsDateTimeOffset(): bool;

    /**
     * Returns true if this reference refers to a decimal type.
     *
     * @return bool this reference refers to a decimal type
     */
    public function IsDecimal(): bool;

    /**
     * Returns true if this reference refers to a floating type.
     *
     * @return bool this reference refers to a floating type
     */
    public function IsFloating(): bool;

    /**
     * Returns true if this reference refers to a single type.
     *
     * @return bool this reference refers to a single type
     */
    public function IsSingle(): bool;

    /**
     * Returns true if this reference refers to a double type.
     *
     * @return bool this reference refers to a double type
     */
    public function IsDouble(): bool;

    /**
     * Returns true if this reference refers to a GUID type.
     *
     * @return bool this reference refers to a GUID type
     */
    public function IsGuid(): bool;

    /**
     * Returns true if this reference refers to a signed integral type.
     *
     * @return bool this reference refers to a signed integral type
     */
    public function IsSignedIntegral(): bool;

    /**
     * Returns true if this reference refers to a SByte type.
     *
     * @return bool this reference refers to a SByte type
     */
    public function IsSByte(): bool;

    /**
     * Returns true if this reference refers to a Int16 type.
     *
     * @return bool this reference refers to a Int16 type
     */
    public function IsInt16(): bool;

    /**
     * Returns true if this reference refers to a Int32 type.
     *
     * @return bool this reference refers to a Int32 type
     */
    public function IsInt32(): bool;

    /**
     * Returns true if this reference refers to a Int64 type.
     *
     * @return bool this reference refers to a Int64 type
     */
    public function IsInt64(): bool;

    /**
     * Returns true if this reference refers to an integer type.
     *
     * @return bool this reference refers to an integer type
     */
    public function IsIntegral(): bool;

    /**
     * Returns true if this reference refers to a byte type.
     *
     * @return bool this reference refers to a byte type
     */
    public function IsByte(): bool;

    /**
     * Returns true if this reference refers to a string type.
     *
     * @return bool this reference refers to a string type
     */
    public function IsString(): bool;

    /**
     * Returns true if this reference refers to a stream type.
     *
     * @return bool this reference refers to a stream type
     */
    public function IsStream(): bool;

    /**
     * Returns true if this reference refers to a spatial type.
     *
     * @return bool this reference refers to a spatial type
     */
    public function IsSpatial(): bool;

    /**
     * If this reference is of a primitive type, this will return a valid primitive type reference to the type definition. Otherwise, it will return a bad primitive type reference.
     *
     * @return IPrimitiveTypeReference A valid primitive type reference if the definition of the reference is of a primitive type. Otherwise a bad primitive type reference.
     */
    public function AsPrimitive(): IPrimitiveTypeReference;

    /**
     * If this reference is of a collection type, this will return a valid collection type reference to the type
     * definition. Otherwise, it will return a bad collection type reference.
     *
     * @return ICollectionTypeReference A valid collection type reference if the definition of the reference is of a collection type. Otherwise a bad collection type reference.
     */
    public function AsCollection(): ICollectionTypeReference;

    /**
     * If this reference is of a structured type, this will return a valid structured type reference to the type definition. Otherwise, it will return a bad structured type reference.
     *
     * @return IStructuredTypeReference A valid structured type reference if the definition of the reference is of a structured type. Otherwise a bad structured type reference.
     */
    public function AsStructured(): IStructuredTypeReference;

    /**
     * If this reference is of an enumeration type, this will return a valid enumeration type reference to the type definition. Otherwise, it will return a bad enumeration type reference.
     *
     * @return IEnumTypeReference A valid enumeration type reference if the definition of the reference is of an enumeration type. Otherwise a bad enumeration type reference.
     */
    public function AsEnum(): IEnumTypeReference;

    /**
     * If this reference is of an entity type, this will return a valid entity type reference to the type definition. Otherwise, it will return a bad entity type reference.
     *
     * @return IEntityTypeReference A valid entity type reference if the definition of the reference is of an entity type. Otherwise a bad entity type reference.
     */
    public function AsEntity(): IEntityTypeReference;

    /**
     * If this reference is of an entity reference type, this will return a valid entity reference type reference to the type definition. Otherwise, it will return a bad entity reference type reference.
     *
     * @return IEntityReferenceTypeReference A valid entity reference type reference if the definition of the reference is of an entity reference type. Otherwise a bad entity reference type reference.
     */
    public function AsEntityReference(): IEntityReferenceTypeReference;

    /**
     * If this reference is of a complex type, this will return a valid complex type reference to the type definition. Otherwise, it will return a bad complex type reference.
     *
     * @return IComplexTypeReference A valid complex type reference if the definition of the reference is of a complex type. Otherwise a bad complex type reference.
     */
    public function AsComplex(): IComplexTypeReference;

    /**
     * If this reference is of a row type, this will return a valid row type reference to the type definition. Otherwise, it will return a bad row type reference.
     *
     * @return IRowTypeReference A valid row type reference if the definition of the reference is of a row type. Otherwise a bad row type reference.
     */
    public function AsRow(): IRowTypeReference;

    /**
     * If this reference is of a spatial type, this will return a valid spatial type reference to the type definition. Otherwise, it will return a bad spatial type reference.
     *
     * @return ISpatialTypeReference A valid spatial type reference if the definition of the reference is of a spatial type. Otherwise a bad spatial type reference.
     */
    public function AsSpatial(): ISpatialTypeReference;

    /**
     * If this reference is of a temporal type, this will return a valid temporal type reference to the type definition. Otherwise, it will return a bad temporal type reference.
     *
     * @return ITemporalTypeReference A valid temporal type reference if the definition of the reference is of a temporal type. Otherwise a bad temporal type reference.
     */
    public function AsTemporal(): ITemporalTypeReference;

    /**
     * If this reference is of a decimal type, this will return a valid decimal type reference to the type definition. Otherwise, it will return a bad decimal type reference.
     *
     * @return IDecimalTypeReference A valid decimal type reference if the definition of the reference is of a decimal type. Otherwise a bad decimal type reference.</returns>
     */
    public function AsDecimal(): IDecimalTypeReference;

    /**
     * If this reference is of a string type, this will return a valid string type reference to the type definition. Otherwise, it will return a bad string type reference.
     *
     * @return IStringTypeReference A valid string type reference if the definition of the reference is of a string type. Otherwise a bad string type reference.
     */
    public function AsString(): IStringTypeReference;

    /**
     * If this reference is of a binary type, this will return a valid binary type reference to the type definition. Otherwise, it will return a bad binary type reference.
     *
     * @return IBinaryTypeReference A valid binary type reference if the definition of the reference is of a binary type. Otherwise a bad binary type reference.
     */
    public function AsBinary(): IBinaryTypeReference;
}
