<?php


namespace AlgoWeb\ODataMetadata\Enums;

/**
 * Class EdmPrimitiveTypeKind
 *
 *  Enumerates the kinds of Edm Primitives.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Enums
 * @method static None(): self Represents a primitive type of unknown kind.
 * @method bool isNone()
 * @method static Binary(): self Represents a Binary type.
 * @method bool isBinary()
 * @method static Boolean(): self Represents a Boolean type.
 * @method bool isBoolean()
 * @method static Byte(): self Represents a Byte type.
 * @method bool isByte()
 * @method static DateTime(): self Represents a DateTime type.
 * @method bool isDateTime()
 * @method static DateTimeOffset(): self Represents a DateTimeOffset type.
 * @method bool isDateTimeOffset()
 * @method static Decimal(): self Represents a Decimal type.
 * @method bool isDecimal()
 * @method static Double(): self Represents a Double type.
 * @method bool isDouble()
 * @method static Guid(): self Represents a Guid type.
 * @method bool isGuid()
 * @method static Int16(): self Represents a Int16 type.
 * @method bool isInt16()
 * @method static Int32(): self Represents a Int32 type.
 * @method bool isInt32()
 * @method static Int64(): self Represents a Int64 type.
 * @method bool isInt64()
 * @method static SByte(): self Represents a SByte type.
 * @method bool isSByte()
 * @method static Single(): self Represents a Single type.
 * @method bool isSingle()
 * @method static String(): self Represents a String type.
 * @method bool isString()
 * @method static Stream(): Represents a Stream type.
 * @method bool isStream()
 * @method static Time(): self Represents a Time type.
 * @method bool isTime()
 * @method static Geography(): self Represents an arbitrary Geography type.
 * @method bool isGeography()
 * @method static GeographyPoint(): self Represents a geography Point type.
 * @method bool isGeographyPoint()
 * @method static GeographyLineString(): self Represents a geography LineString type.
 * @method bool isGeographyLineString()
 * @method static GeographyPolygon(): self Represents a geography Polygon type.
 * @method bool isGeographyPolygon()
 * @method static GeographyMultiPolygon(): self Represents a geography MultiPoint type.
 * @method bool isGeographyMultiPolygon()
 * @method static GeographyMultiLineString(): self Represents a geography MultiLineString type.
 * @method bool isGeographyMultiLineString()
 * @method static GeographyMultiPoint(): self Represents a geography MultiPolygon type.
 * @method bool isGeographyMultiPoint()
 * @method static GeographyCollection(): self Represents a geography GeographyCollection type.
 * @method bool isGeographyCollection()
 * @method static Geometry(): self Represents an arbitrary Geometry type.
 * @method bool isGeometry()
 * @method static GeometryPoint(): self Represents a geometry Point type.
 * @method bool isGeometryPoint()
 * @method static GeometryLineString(): self Represents a geometry LineString type.
 * @method bool isGeometryLineString()
 * @method static GeometryPolygon(): self Represents a geometry Polygon type.
 * @method bool isGeometryPolygon()
 * @method static GeometryMultiPoint(): self Represents a geometry MultiPoint type.
 * @method bool isGeometryMultiPoint()
 * @method static GeometryMultiLineString(): self  Represents a geometry MultiLineString type.
 * @method bool isGeometryMultiLineString()
 * @method static GeometryMultiPolygon(): self Represents a geometry MultiPolygon type.
 * @method bool isGeometryMultiPolygon()
 * @method static GeometryCollection(): self  Represents a geometry GeometryCollection type.
 * @method bool isGeometryCollection()
 */
class PrimitiveTypeKind extends Enum
{
    /**
     * Represents a primitive type of unknown kind.
     */
    protected const None = '';
// V1-2
    protected const Binary = 'Edm.Binary';
    protected const Boolean = 'Edm.Boolean';
    protected const Byte = 'Edm.Byte';
    protected const DateTime = 'Edm.DateTime';
    protected const DateTimeOffset = 'Edm.DateTimeOffset';
    protected const Time = 'Edm.Time';
    protected const Decimal = 'Edm.Decimal';
    protected const Double = 'Edm.Double';
    protected const Single = 'Edm.Single';
    protected const Guid = 'Edm.Guid';
    protected const Int16 = 'Edm.Int16';
    protected const Int32 = 'Edm.Int32';
    protected const Int64 = 'Edm.Int64';
    protected const String = 'Edm.String';
    protected const SByte = 'Edm.SByte';
    protected const Stream = 'Edm.Stream'; //TODO: check this value,.
    //V3
    protected const Geography = 'Edm.Geography';
    protected const GeographyPoint = 'Edm.Point';
    protected const GeographyLineString = 'Edm.LineString';
    protected const GeographyPolygon = 'Edm.Polygon';
    protected const GeographyMultiPolygon = 'Edm.MultiPoint';
    protected const GeographyMultiLineString = 'Edm.MultiLineString';
    protected const GeographyMultiPoint = 'Edm.MultiPolygon';
    protected const GeographyCollection = 'Edm.GeographyCollection';
    protected const Geometry = 'Edm.Geometry';
    protected const GeometryPoint = 'Edm.GeometricPoint';
    protected const GeometryLineString = 'Edm.GeometricLineString';
    protected const GeometryPolygon = 'Edm.Edm.GeometricPolygon';
    protected const GeometryMultiPoint = 'Edm.GeometricMultiPoint';
    protected const GeometryMultiLineString = 'Edm.GeometricMultiLineString';
    protected const GeometryMultiPolygon = 'Edm.GeometricMultiPolygon';
    protected const GeometryCollection = 'Edm.GeometryCollection';

    /**
     * Returns true if this type kind represents a spatial type.
     *
     * @return bool This kind refers to a spatial type.
     */
    public function IsSpatial(): bool
    {
        $spatialTypes = [
            self::Geography(),
            self::GeographyPoint(),
            self::GeographyLineString(),
            self::GeographyPolygon(),
            self::GeographyCollection(),
            self::GeographyMultiPoint(),
            self::GeographyMultiLineString(),
            self::GeographyMultiPolygon(),
            self::Geometry(),
            self::GeometryPoint(),
            self::GeometryLineString(),
            self::GeometryPolygon(),
            self::GeometryCollection(),
            self::GeometryMultiPolygon(),
            self::GeometryMultiLineString(),
            self::GeometryMultiPoint()
        ];
        return in_array($this, $spatialTypes);
    }

    /**
     * Returns true if this type kind represents a temporal type.
     *
     * @return bool This kind refers to a temporal type.
     */
    public  function IsTemporal(): bool
    {
        $temporalTypes = [
             self::Time(),
             self::DateTime(),
             self::DateTimeOffset(),
        ];
        return in_array($this, $temporalTypes);
    }

    /**
     * Returns true if this primitive type kind represents an integer type.
     *
     * @return bool This kind refers to an integer type.
     */
    public function IsIntegral(): bool
    {
        $integralTypes = [
             self::Int64(),
             self::Int32(),
             self::Int16(),
             self::Byte(),
             self::SByte(),
        ];
        return in_array($this, $integralTypes);
    }


    /**
     * Returns true if this reference refers to a signed integral type.
     *
     * @return bool This reference refers to a signed integral type.
     */
    public function isSignedIntegral(): bool
    {

        return $this == PrimitiveTypeKind::SByte() ||
            $this == PrimitiveTypeKind::Int16() ||
            $this == PrimitiveTypeKind::Int32() ||
            $this == PrimitiveTypeKind::Int64();
    }
}