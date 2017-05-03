<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits;

trait EDMSimpleTypeTrait
{
    //EDM SimpleType instances for use by EDM Instance documents

    private $validType = ["Binary", "Boolean", "Byte", "DateTime", "DateTimeOffset", "Time", "Decimal", "Double",
        "Single", "Geography", "Point", "LineString", "Polygon", "MultiPoint", "MultiLineString", "MultiPolygon",
        "GeographyCollection", "Geometry", "GeometricPoint", "GeometricLineString", "GeometricPolygon",
        "GeometricMultiPoint", "GeometricMultiLineString", "GeometricMultiPolygon", "GeometryCollection",
        "Guid", "Int16", "Int32", "Int64", "String", "SByte"];

    public function isEDMSimpleTypeValid($string)
    {
        if (!is_string($string)) {
            throw new \InvalidArgumentException("Input must be a string");
        }
        if (!in_array($string, $this->validType)) {
            return false;
        }
        return true;
    }
}
