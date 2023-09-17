<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Enums;

/**
 * Class EdmPrimitiveTypeKind.
 *
 *  Enumerates the kinds of Edm Primitives.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Enums
 * @method static self None() Represents a primitive type of unknown kind.
 * @method bool   isNone()
 * @method static self Binary(): self Represents a Binary type.
 * @method bool isBinary()
 * @method static self Boolean(): self Represents a Boolean type.
 * @method bool isBoolean()
 * @method static self Byte(): self Represents a Byte type.
 * @method bool isByte()
 * @method static self DateTime(): self Represents a DateTime type.
 * @method bool isDateTime()
 * @method static self DateTimeOffset(): self Represents a DateTimeOffset type.
 * @method bool isDateTimeOffset()
 * @method static self Decimal(): self Represents a Decimal type.
 * @method bool isDecimal()
 * @method static self Double(): self Represents a Double type.
 * @method bool isDouble()
 * @method static self Guid(): self Represents a Guid type.
 * @method bool isGuid()
 * @method static self Int16(): self Represents a Int16 type.
 * @method bool isInt16()
 * @method static self Int32(): self Represents a Int32 type.
 * @method bool isInt32()
 * @method static self Int64(): self Represents a Int64 type.
 * @method bool isInt64()
 * @method static self SByte(): self Represents a SByte type.
 * @method bool isSByte()
 * @method static self Single(): self Represents a Single type.
 * @method bool isSingle()
 * @method static self String(): self Represents a String type.
 * @method bool isString()
 * @method static self Stream(): Represents a Stream type.
 * @method bool isStream()
 * @method static self Time(): self Represents a Time type.
 * @method bool isTime()
 * @method static self Geography(): self Represents an arbitrary Geography type.
 * @method bool isGeography()
 * @method static self GeographyPoint(): self Represents a geography Point type.
 * @method bool isGeographyPoint()
 * @method static self GeographyLineString(): self Represents a geography LineString type.
 * @method bool isGeographyLineString()
 * @method static self GeographyPolygon(): self Represents a geography Polygon type.
 * @method bool isGeographyPolygon()
 * @method static self GeographyMultiPolygon(): self Represents a geography MultiPoint type.
 * @method bool isGeographyMultiPolygon()
 * @method static self GeographyMultiLineString(): self Represents a geography MultiLineString type.
 * @method bool isGeographyMultiLineString()
 * @method static self GeographyMultiPoint(): self Represents a geography MultiPolygon type.
 * @method bool isGeographyMultiPoint()
 * @method static self GeographyCollection(): self Represents a geography GeographyCollection type.
 * @method bool isGeographyCollection()
 * @method static self Geometry(): self Represents an arbitrary Geometry type.
 * @method bool isGeometry()
 * @method static self GeometryPoint(): self Represents a geometry Point type.
 * @method bool isGeometryPoint()
 * @method static self GeometryLineString(): self Represents a geometry LineString type.
 * @method bool isGeometryLineString()
 * @method static self GeometryPolygon(): self Represents a geometry Polygon type.
 * @method bool isGeometryPolygon()
 * @method static self GeometryMultiPoint(): self Represents a geometry MultiPoint type.
 * @method bool isGeometryMultiPoint()
 * @method static self GeometryMultiLineString(): self  Represents a geometry MultiLineString type.
 * @method bool isGeometryMultiLineString()
 * @method static self GeometryMultiPolygon(): self Represents a geometry MultiPolygon type.
 * @method bool isGeometryMultiPolygon()
 * @method static self GeometryCollection(): self  Represents a geometry GeometryCollection type.
 * @method bool isGeometryCollection()
 */
class PrimitiveTypeKind extends Enum
{
    /**
     * Represents a primitive type of unknown kind.
     */
    protected const None = '';
    // V1-2
    protected const Binary         = 'Edm.Binary';
    protected const Boolean        = 'Edm.Boolean';
    protected const Byte           = 'Edm.Byte';
    protected const DateTime       = 'Edm.DateTime';
    protected const DateTimeOffset = 'Edm.DateTimeOffset';
    protected const Time           = 'Edm.Time';
    protected const Decimal        = 'Edm.Decimal';
    protected const Double         = 'Edm.Double';
    protected const Single         = 'Edm.Single';
    protected const Guid           = 'Edm.Guid';
    protected const Int16          = 'Edm.Int16';
    protected const Int32          = 'Edm.Int32';
    protected const Int64          = 'Edm.Int64';
    protected const String         = 'Edm.String';
    protected const SByte          = 'Edm.SByte';
    protected const Stream         = 'Edm.Stream'; //TODO: check this value,.
    //V3
    protected const Geography                = 'Edm.Geography';
    protected const GeographyPoint           = 'Edm.Point';
    protected const GeographyLineString      = 'Edm.LineString';
    protected const GeographyPolygon         = 'Edm.Polygon';
    protected const GeographyMultiPolygon    = 'Edm.MultiPoint';
    protected const GeographyMultiLineString = 'Edm.MultiLineString';
    protected const GeographyMultiPoint      = 'Edm.MultiPolygon';
    protected const GeographyCollection      = 'Edm.GeographyCollection';
    protected const Geometry                 = 'Edm.Geometry';
    protected const GeometryPoint            = 'Edm.GeometricPoint';
    protected const GeometryLineString       = 'Edm.GeometricLineString';
    protected const GeometryPolygon          = 'Edm.Edm.GeometricPolygon';
    protected const GeometryMultiPoint       = 'Edm.GeometricMultiPoint';
    protected const GeometryMultiLineString  = 'Edm.GeometricMultiLineString';
    protected const GeometryMultiPolygon     = 'Edm.GeometricMultiPolygon';
    protected const GeometryCollection       = 'Edm.GeometryCollection';

    /**
     * Returns true if this type kind represents a spatial type.
     *
     * @return bool this kind refers to a spatial type
     */
    public function IsSpatial(): bool
    {
        $spatialTypes = [
            self::Geography,
            self::GeographyPoint,
            self::GeographyLineString,
            self::GeographyPolygon,
            self::GeographyCollection,
            self::GeographyMultiPoint,
            self::GeographyMultiLineString,
            self::GeographyMultiPolygon,
            self::Geometry,
            self::GeometryPoint,
            self::GeometryLineString,
            self::GeometryPolygon,
            self::GeometryCollection,
            self::GeometryMultiPolygon,
            self::GeometryMultiLineString,
            self::GeometryMultiPoint
        ];
        return in_array($this->getValue(), $spatialTypes);
    }

    /**
     * Returns true if this type kind represents a temporal type.
     *
     * @return bool this kind refers to a temporal type
     */
    public function isTemporal(): bool
    {
        $temporalTypes = [
            self::Time,
            self::DateTime,
            self::DateTimeOffset,
        ];
        return in_array($this->getValue(), $temporalTypes);
    }

    /**
     * Returns true if this primitive type kind represents an integer type.
     *
     * @return bool this kind refers to an integer type
     */
    public function isIntegral(): bool
    {
        $integralTypes = [
            self::Int64,
            self::Int32,
            self::Int16,
            self::Byte,
            self::SByte,
        ];
        return in_array($this->getValue(), $integralTypes);
    }


    /**
     * Returns true if this reference refers to a signed integral type.
     *
     * @return bool this reference refers to a signed integral type
     */
    public function isSignedIntegral(): bool
    {
        $value = $this->getValue();

        $signedIntegralTypes = [
            self::Int64,
            self::Int32,
            self::Int16,
            self::SByte,
        ];

        return in_array($value, $signedIntegralTypes);
    }
}
