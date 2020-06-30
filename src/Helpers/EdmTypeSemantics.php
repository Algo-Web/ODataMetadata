<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Helpers;

use AlgoWeb\ODataMetadata\Enums\PrimitiveTypeKind;
use AlgoWeb\ODataMetadata\Exception\InvalidOperationException;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveType;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveTypeReference;
use AlgoWeb\ODataMetadata\Library\EdmBinaryTypeReference;
use AlgoWeb\ODataMetadata\Library\EdmDecimalTypeReference;
use AlgoWeb\ODataMetadata\Library\EdmPrimitiveTypeReference;
use AlgoWeb\ODataMetadata\Library\EdmSpatialTypeReference;
use AlgoWeb\ODataMetadata\Library\EdmStringTypeReference;
use AlgoWeb\ODataMetadata\Library\EdmTemporalTypeReference;
use AlgoWeb\ODataMetadata\StringConst;

abstract class EdmTypeSemantics
{
    public static function GetPrimitiveTypeReference(IPrimitiveType $type, bool $isNullable): IPrimitiveTypeReference
    {
        switch ($type->getPrimitiveKind()) {
            case PrimitiveTypeKind::Boolean():
            case PrimitiveTypeKind::Byte():
            case PrimitiveTypeKind::Double():
            case PrimitiveTypeKind::Guid():
            case PrimitiveTypeKind::Int16():
            case PrimitiveTypeKind::Int32():
            case PrimitiveTypeKind::Int64():
            case PrimitiveTypeKind::SByte():
            case PrimitiveTypeKind::Single():
            case PrimitiveTypeKind::Stream():
                return new EdmPrimitiveTypeReference($type, $isNullable);
            case PrimitiveTypeKind::Binary():
                return new EdmBinaryTypeReference($type, $isNullable);
            case PrimitiveTypeKind::String():
                return new EdmStringTypeReference($type, $isNullable);
            case PrimitiveTypeKind::Decimal():
                return new EdmDecimalTypeReference($type, $isNullable);
            case PrimitiveTypeKind::DateTime():
            case PrimitiveTypeKind::DateTimeOffset():
            case PrimitiveTypeKind::Time():
                return new EdmTemporalTypeReference($type, $isNullable);
            case PrimitiveTypeKind::Geography():
            case PrimitiveTypeKind::GeographyPoint():
            case PrimitiveTypeKind::GeographyLineString():
            case PrimitiveTypeKind::GeographyPolygon():
            case PrimitiveTypeKind::GeographyCollection():
            case PrimitiveTypeKind::GeographyMultiPolygon():
            case PrimitiveTypeKind::GeographyMultiLineString():
            case PrimitiveTypeKind::GeographyMultiPoint():
            case PrimitiveTypeKind::Geometry():
            case PrimitiveTypeKind::GeometryPoint():
            case PrimitiveTypeKind::GeometryLineString():
            case PrimitiveTypeKind::GeometryPolygon():
            case PrimitiveTypeKind::GeometryCollection():
            case PrimitiveTypeKind::GeometryMultiPolygon():
            case PrimitiveTypeKind::GeometryMultiLineString():
            case PrimitiveTypeKind::GeometryMultiPoint():
                return new EdmSpatialTypeReference($type, $isNullable);
            default:
                throw new InvalidOperationException(StringConst::EdmPrimitive_UnexpectedKind());
        }
    }
}
