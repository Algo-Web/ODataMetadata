<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\MetadataV3;

use AlgoWeb\ODataMetadata\MetadataV3\Edm\OtherTypeConstructs\INominalType;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\OtherTypeConstructs\IScalarType;
use DOMElement;
use MyCLabs\Enum\Enum;

class EDMSimpleType extends Enum implements INominalType, IScalarType
{
    // V3
    protected const Geography = 'Edm.Geography';
    protected const Point = 'Edm.Point';
    protected const LineString = 'Edm.LineString';
    protected const Polygon = 'Edm.Polygon';
    protected const MultiPoint = 'Edm.MultiPoint';
    protected const MultiLineString = 'Edm.MultiLineString';
    protected const MultiPolygon = 'Edm.MultiPolygon';
    protected const GeographyCollection = 'Edm.GeographyCollection';
    protected const Geometry = 'Edm.Geometry';
    protected const GeometricPoint = 'Edm.GeometricPoint';
    protected const GeometricLineString = 'Edm.GeometricLineString';
    protected const GeometricPolygon = 'Edm.Edm.GeometricPolygon';
    protected const GeometricMultiPoint = 'Edm.GeometricMultiPoint';
    protected const GeometricMultiLineString = 'Edm.GeometricMultiLineString';
    protected const GeometricMultiPolygon = 'Edm.GeometricMultiPolygon';
    protected const GeometryCollection = 'Edm.GeometryCollection';

    public function getName(): string
    {
        return strval($this);
    }

    public function isAttribute(): bool
    {
        return true;
    }
}
