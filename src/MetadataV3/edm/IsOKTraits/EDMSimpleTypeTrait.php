<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits;

trait EDMSimpleTypeTrait
{
    protected static $v3EDMSimpleType = ["Binary", "Boolean", "Byte", "DateTime", "DateTimeOffset", "Time", "Decimal",
        "Double", "Single", "Geography", "Point", "LineString", "Polygon", "MultiPoint", "MultiLineString",
        "MultiPolygon", "GeographyCollection", "Geometry", "GeometricPoint", "GeometricLineString", "GeometricPolygon",
        "GeometricMultiPoint", "GeometricMultiLineString", "GeometricMultiPolygon", "GeometryCollection",
        "Guid", "Int16", "Int32", "Int64", "String", "SByte"];

    //EDM SimpleType instances for use by EDM Instance documents
    public function isEDMSimpleTypeValid($string)
    {
        if (!is_string($string)) {
            $msg = "Input must be a string: " . get_class($this);
            throw new \InvalidArgumentException($msg);
        }
        if (!in_array($string, static::$v3EDMSimpleType)) {
            return false;
        }
        return true;
    }
}
