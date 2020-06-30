<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 21/06/20
 * Time: 2:42 AM.
 */
namespace AlgoWeb\ODataMetadata\Tests\Unit\Helpers;

use AlgoWeb\ODataMetadata\Enums\PrimitiveTypeKind;
use AlgoWeb\ODataMetadata\Helpers\ToTraceString;
use AlgoWeb\ODataMetadata\Interfaces\IBinaryTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\ICollectionType;
use AlgoWeb\ODataMetadata\Interfaces\IDecimalTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntityReferenceType;
use AlgoWeb\ODataMetadata\Interfaces\IEntityType;
use AlgoWeb\ODataMetadata\Interfaces\IProperty;
use AlgoWeb\ODataMetadata\Interfaces\IRowType;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaElement;
use AlgoWeb\ODataMetadata\Interfaces\ISpatialTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IStringTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\ITemporalTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class ToTraceStringTest extends TestCase
{
    public function testTraceStringSchemaElement()
    {
        $element = m::mock(IEdmElement::class . ', ' . ISchemaElement::class)->makePartial();
        $element->shouldReceive('FullName')->andReturn('FullName');

        $expected = 'FullName';
        $actual   = ToTraceString::ToTraceString($element);

        $this->assertEquals($expected, $actual);
    }

    public function testTraceStringDefaultElement()
    {
        $element = m::mock(IEdmElement::class)->makePartial();
        $element->shouldReceive('FullName')->andReturn('FullName');

        $expected = 'UnknownType';
        $actual   = ToTraceString::ToTraceString($element);

        $this->assertEquals($expected, $actual);
    }

    public function testTraceStringPropertyElementNoType()
    {
        $element = m::mock(IEdmElement::class . ', ' . IProperty::class)->makePartial();
        $element->shouldReceive('getType')->andReturn(null);
        $element->shouldReceive('getName')->andReturn('Name');

        $expected = 'Name';
        $actual   = ToTraceString::ToTraceString($element);

        $this->assertEquals($expected, $actual);
    }

    public function testTraceStringPropertyElementHasNonNullableType()
    {
        $typeRef = m::mock(IEdmElement::class . ', ' . ITypeReference::class)->makePartial();
        $typeRef->shouldReceive('isPrimitive')->andReturn(false)->once();
        $typeRef->shouldReceive('getNullable')->andReturn(false)->once();
        $typeRef->shouldReceive('getDefinition')->andReturn(null);

        $element = m::mock(IEdmElement::class . ', ' . IProperty::class)->makePartial();
        $element->shouldReceive('getType')->andReturn($typeRef);
        $element->shouldReceive('getName')->andReturn(null);

        $expected = ':[UnknownType Nullable=FALSE]';
        $actual   = ToTraceString::ToTraceString($element);

        $this->assertEquals($expected, $actual);
    }

    public function testTraceStringEntityReferenceElementNullType()
    {
        $element = m::mock(IEdmElement::class . ', ' . IEntityReferenceType::class)->makePartial();
        $element->shouldReceive('getEntityType')->andReturn(null);

        $expected = 'EntityReference()';
        $actual   = ToTraceString::ToTraceString($element);

        $this->assertEquals($expected, $actual);
    }

    public function testTraceStringEntityReferenceElementHasType()
    {
        $eType = m::mock(IEntityType::class)->makePartial();
        $eType->shouldReceive('FullName')->andReturn('FullName');

        $element = m::mock(IEdmElement::class . ', ' . IEntityReferenceType::class)->makePartial();
        $element->shouldReceive('getEntityType')->andReturn($eType);

        $expected = 'EntityReference(FullName)';
        $actual   = ToTraceString::ToTraceString($element);

        $this->assertEquals($expected, $actual);
    }

    public function testTraceStringEntityCollectionElementNullType()
    {
        $element = m::mock(IEdmElement::class . ', ' . ICollectionType::class)->makePartial();
        $element->shouldReceive('getElementType')->andReturn(null);

        $expected = 'Collection()';
        $actual   = ToTraceString::ToTraceString($element);

        $this->assertEquals($expected, $actual);
    }

    public function testTraceStringEntityCollectionElementHasType()
    {
        $eType = m::mock(IEdmElement::class . ', ' . ITypeReference::class)->makePartial();
        $eType->shouldReceive('FullName')->andReturn('FullName');
        $eType->shouldReceive('getDefinition')->andReturn(null);
        $eType->shouldReceive('getNullable')->andReturn(true);
        $eType->shouldReceive('isPrimitive')->andReturn(false);

        $element = m::mock(IEdmElement::class . ', ' . ICollectionType::class)->makePartial();
        $element->shouldReceive('getElementType')->andReturn($eType);

        $expected = 'Collection([UnknownType Nullable=TRUE])';
        $actual   = ToTraceString::ToTraceString($element);

        $this->assertEquals($expected, $actual);
    }

    public function testTraceStringRowType()
    {
        $prop1 = m::mock(IEdmElement::class . ', ' . ISchemaElement::class)->makePartial();
        $prop1->shouldReceive('FullName')->andReturn('FullName');

        $element = m::mock(IEdmElement::class . ', ' . IRowType::class)->makePartial();
        $element->shouldReceive('Properties')->andReturn([$prop1, null]);

        $expected = 'Row(FullName)';
        $actual   = ToTraceString::ToTraceString($element);

        $this->assertEquals($expected, $actual);
    }

    public function binaryFacetProvider(): array
    {
        $result   = [];
        $result[] = [true, false, null, true, '[UnknownType Nullable=TRUE]'];
        $result[] = [true, false, null, false, '[UnknownType Nullable=FALSE]'];
        $result[] = [true, false, 10, true, '[UnknownType Nullable=TRUE MaxLength=10]'];
        $result[] = [true, false, 10, false, '[UnknownType Nullable=FALSE MaxLength=10]'];
        $result[] = [true, true, null, true, '[UnknownType Nullable=TRUE MaxLength=Max]'];
        $result[] = [true, true, null, false, '[UnknownType Nullable=FALSE MaxLength=Max]'];
        $result[] = [true, true, 10, true, '[UnknownType Nullable=TRUE MaxLength=Max]'];
        $result[] = [true, true, 10, false, '[UnknownType Nullable=FALSE MaxLength=Max]'];
        $result[] = [false, false, null, true, '[UnknownType Nullable=TRUE]'];
        $result[] = [false, false, null, false, '[UnknownType Nullable=FALSE]'];
        $result[] = [false, false, 10, true, '[UnknownType Nullable=TRUE MaxLength=10]'];
        $result[] = [false, false, 10, false, '[UnknownType Nullable=FALSE MaxLength=10]'];
        $result[] = [false, true, null, true, '[UnknownType Nullable=TRUE MaxLength=Max]'];
        $result[] = [false, true, null, false, '[UnknownType Nullable=FALSE MaxLength=Max]'];
        $result[] = [false, true, 10, true, '[UnknownType Nullable=TRUE MaxLength=Max]'];
        $result[] = [false, true, 10, false, '[UnknownType Nullable=FALSE MaxLength=Max]'];

        return $result;
    }

    /**
     * @dataProvider binaryFacetProvider
     *
     * @param bool     $isFixed
     * @param bool     $isUnbounded
     * @param int|null $maxLen
     * @param bool     $isNullable
     * @param string   $expected
     */
    public function testTraceStringBinaryFacet(bool $isFixed, bool $isUnbounded, ?int $maxLen, bool $isNullable, string $expected)
    {
        $binRef = m::mock(IBinaryTypeReference::class)->makePartial();
        $binRef->shouldReceive('isFixedLength')->andReturn($isFixed);
        $binRef->shouldReceive('isUnBounded')->andReturn($isUnbounded);
        $binRef->shouldReceive('getMaxLength')->andReturn($maxLen);
        $binRef->shouldReceive('PrimitiveKind')->andReturn(PrimitiveTypeKind::Binary());
        $binRef->shouldReceive('AsBinary')->andReturn($binRef);

        $element = m::mock(IEdmElement::class . ', ' . ITypeReference::class)->makePartial();
        $element->shouldReceive('FullName')->andReturn('FullName');
        $element->shouldReceive('isPrimitive')->andReturn(true);
        $element->shouldReceive('asPrimitive')->andReturn($binRef);
        $element->shouldReceive('getDefinition')->andReturn(null);
        $element->shouldReceive('getNullable')->andReturn($isNullable);

        $actual = ToTraceString::ToTraceString($element);

        $this->assertEquals($expected, $actual);
    }

    public function decimalFacetProvider(): array
    {
        $result   = [];
        $result[] = [null, null, true, '[UnknownType Nullable=TRUE]'];
        $result[] = [8, null, false, '[UnknownType Nullable=FALSE Precision=8]'];
        $result[] = [null, 4, true, '[UnknownType Nullable=TRUE Scale=4]'];
        $result[] = [8, 4, false, '[UnknownType Nullable=FALSE Precision=8 Scale=4]'];

        return $result;
    }

    /**
     * @dataProvider decimalFacetProvider
     *
     * @param int|null $precision
     * @param int|null $scale
     * @param bool     $isNullable
     * @param string   $expected
     */
    public function testTraceStringDecimalFacet(?int $precision, ?int $scale, bool $isNullable, string $expected)
    {
        $binRef = m::mock(IDecimalTypeReference::class)->makePartial();
        $binRef->shouldReceive('PrimitiveKind')->andReturn(PrimitiveTypeKind::Decimal());
        $binRef->shouldReceive('AsDecimal')->andReturn($binRef);
        $binRef->shouldReceive('getPrecision')->andReturn($precision);
        $binRef->shouldReceive('getScale')->andReturn($scale);

        $element = m::mock(IEdmElement::class . ', ' . ITypeReference::class)->makePartial();
        $element->shouldReceive('FullName')->andReturn('FullName');
        $element->shouldReceive('isPrimitive')->andReturn(true);
        $element->shouldReceive('asPrimitive')->andReturn($binRef);
        $element->shouldReceive('getDefinition')->andReturn(null);
        $element->shouldReceive('getNullable')->andReturn($isNullable);

        $actual = ToTraceString::ToTraceString($element);

        $this->assertEquals($expected, $actual);
    }

    public function temporalFacetProvider(): array
    {
        $result   = [];
        $result[] = [PrimitiveTypeKind::Time(), null, '[UnknownType Nullable=TRUE]'];
        $result[] = [PrimitiveTypeKind::DateTime(), null, '[UnknownType Nullable=TRUE]'];
        $result[] = [PrimitiveTypeKind::DateTimeOffset(), null, '[UnknownType Nullable=TRUE]'];
        $result[] = [PrimitiveTypeKind::Time(), 4, '[UnknownType Nullable=TRUE Precision=4]'];
        $result[] = [PrimitiveTypeKind::DateTime(), 4, '[UnknownType Nullable=TRUE Precision=4]'];
        $result[] = [PrimitiveTypeKind::DateTimeOffset(), 4, '[UnknownType Nullable=TRUE Precision=4]'];

        return $result;
    }

    /**
     * @dataProvider temporalFacetProvider
     *
     * @param PrimitiveTypeKind $typeKind
     * @param int|null          $precision
     * @param string            $expected
     */
    public function testTraceStringTemporalFacet(PrimitiveTypeKind $typeKind, ?int $precision, string $expected)
    {
        $binRef = m::mock(ITemporalTypeReference::class)->makePartial();
        $binRef->shouldReceive('PrimitiveKind')->andReturn($typeKind);
        $binRef->shouldReceive('AsTemporal')->andReturn($binRef);
        $binRef->shouldReceive('getPrecision')->andReturn($precision);

        $element = m::mock(IEdmElement::class . ', ' . ITypeReference::class)->makePartial();
        $element->shouldReceive('FullName')->andReturn('FullName');
        $element->shouldReceive('isPrimitive')->andReturn(true);
        $element->shouldReceive('asPrimitive')->andReturn($binRef);
        $element->shouldReceive('getDefinition')->andReturn(null);
        $element->shouldReceive('getNullable')->andReturn(true);

        $actual = ToTraceString::ToTraceString($element);

        $this->assertEquals($expected, $actual);
    }

    public function stringFacetProvider(): array
    {
        $result   = [];
        $result[] = [null, false, null, null, 'collate', '[UnknownType Nullable=TRUE Collation=collate]'];
        $result[] = [true, false, 10, null, null, '[UnknownType Nullable=TRUE FixedLength=TRUE MaxLength=10]'];
        $result[] = [false, false, null, null, 'collate', '[UnknownType Nullable=TRUE Collation=collate]'];
        $result[] = [null, true, 10, null, null, '[UnknownType Nullable=TRUE MaxLength=Max]'];
        $result[] = [true, true, null, null, 'collate', '[UnknownType Nullable=TRUE FixedLength=TRUE MaxLength=Max Collation=collate]'];
        $result[] = [false, true, 10, null, null, '[UnknownType Nullable=TRUE MaxLength=Max]'];
        $result[] = [null, false, null, true, 'collate', '[UnknownType Nullable=TRUE Unicode=TRUE Collation=collate]'];
        $result[] = [true, false, 10, true, null, '[UnknownType Nullable=TRUE FixedLength=TRUE MaxLength=10 Unicode=TRUE]'];
        $result[] = [false, false, true, null, 'collate', '[UnknownType Nullable=TRUE MaxLength=1 Collation=collate]'];
        $result[] = [null, true, 10, false, null, '[UnknownType Nullable=TRUE MaxLength=Max]'];
        $result[] = [true, true, null, false, 'collate', '[UnknownType Nullable=TRUE FixedLength=TRUE MaxLength=Max Collation=collate]'];
        $result[] = [false, true, 10, false, null, '[UnknownType Nullable=TRUE MaxLength=Max]'];

        return $result;
    }

    /**
     * @dataProvider stringFacetProvider
     *
     * @param bool|null   $isFixedLen
     * @param bool        $isUnbounded
     * @param int|null    $maxLen
     * @param bool|null   $isUnicode
     * @param string|null $collation
     * @param string      $expected
     */
    public function testTraceStringStringFacet(?bool $isFixedLen, bool $isUnbounded, ?int $maxLen, ?bool $isUnicode, ?string $collation, string $expected)
    {
        $binRef = m::mock(IStringTypeReference::class)->makePartial();
        $binRef->shouldReceive('PrimitiveKind')->andReturn(PrimitiveTypeKind::String());
        $binRef->shouldReceive('AsString')->andReturn($binRef);
        $binRef->shouldReceive('isFixedLength')->andReturn($isFixedLen);
        $binRef->shouldReceive('isUnbounded')->andReturn($isUnbounded);
        $binRef->shouldReceive('getMaxLength')->andReturn($maxLen);
        $binRef->shouldReceive('isUnicode')->andReturn($isUnicode);
        $binRef->shouldReceive('getCollation')->andReturn($collation);

        $element = m::mock(IEdmElement::class . ', ' . ITypeReference::class)->makePartial();
        $element->shouldReceive('FullName')->andReturn('FullName');
        $element->shouldReceive('isPrimitive')->andReturn(true);
        $element->shouldReceive('asPrimitive')->andReturn($binRef);
        $element->shouldReceive('getDefinition')->andReturn(null);
        $element->shouldReceive('getNullable')->andReturn(true);

        $actual = ToTraceString::ToTraceString($element);

        $this->assertEquals($expected, $actual);
    }

    public function spatialFacetProvider(): array
    {
        $result   = [];
        $result[] = [PrimitiveTypeKind::Geography(), null, '[UnknownType Nullable=TRUE SRID=Variable]'];
        $result[] = [PrimitiveTypeKind::Geography(), 11, '[UnknownType Nullable=TRUE SRID=11]'];
        $result[] = [PrimitiveTypeKind::GeographyPoint(), null, '[UnknownType Nullable=TRUE SRID=Variable]'];
        $result[] = [PrimitiveTypeKind::GeographyPoint(), 11, '[UnknownType Nullable=TRUE SRID=11]'];
        $result[] = [PrimitiveTypeKind::GeographyLineString(), null, '[UnknownType Nullable=TRUE SRID=Variable]'];
        $result[] = [PrimitiveTypeKind::GeographyLineString(), 11, '[UnknownType Nullable=TRUE SRID=11]'];
        $result[] = [PrimitiveTypeKind::GeographyPolygon(), null, '[UnknownType Nullable=TRUE SRID=Variable]'];
        $result[] = [PrimitiveTypeKind::GeographyPolygon(), 11, '[UnknownType Nullable=TRUE SRID=11]'];
        $result[] = [PrimitiveTypeKind::GeographyCollection(), null, '[UnknownType Nullable=TRUE SRID=Variable]'];
        $result[] = [PrimitiveTypeKind::GeographyCollection(), 11, '[UnknownType Nullable=TRUE SRID=11]'];
        $result[] = [PrimitiveTypeKind::GeographyLineString(), null, '[UnknownType Nullable=TRUE SRID=Variable]'];
        $result[] = [PrimitiveTypeKind::GeographyLineString(), 11, '[UnknownType Nullable=TRUE SRID=11]'];
        $result[] = [PrimitiveTypeKind::GeographyMultiPoint(), null, '[UnknownType Nullable=TRUE SRID=Variable]'];
        $result[] = [PrimitiveTypeKind::GeographyMultiPoint(), 11, '[UnknownType Nullable=TRUE SRID=11]'];
        $result[] = [PrimitiveTypeKind::GeographyMultiLineString(), null, '[UnknownType Nullable=TRUE SRID=Variable]'];
        $result[] = [PrimitiveTypeKind::GeographyMultiLineString(), 11, '[UnknownType Nullable=TRUE SRID=11]'];
        $result[] = [PrimitiveTypeKind::GeographyMultiPolygon(), null, '[UnknownType Nullable=TRUE SRID=Variable]'];
        $result[] = [PrimitiveTypeKind::GeographyMultiPolygon(), 11, '[UnknownType Nullable=TRUE SRID=11]'];
        $result[] = [PrimitiveTypeKind::Geometry(), null, '[UnknownType Nullable=TRUE SRID=Variable]'];
        $result[] = [PrimitiveTypeKind::Geometry(), 11, '[UnknownType Nullable=TRUE SRID=11]'];
        $result[] = [PrimitiveTypeKind::GeometryPoint(), null, '[UnknownType Nullable=TRUE SRID=Variable]'];
        $result[] = [PrimitiveTypeKind::GeometryPoint(), 11, '[UnknownType Nullable=TRUE SRID=11]'];
        $result[] = [PrimitiveTypeKind::GeometryLineString(), null, '[UnknownType Nullable=TRUE SRID=Variable]'];
        $result[] = [PrimitiveTypeKind::GeometryLineString(), 11, '[UnknownType Nullable=TRUE SRID=11]'];
        $result[] = [PrimitiveTypeKind::GeometryPolygon(), null, '[UnknownType Nullable=TRUE SRID=Variable]'];
        $result[] = [PrimitiveTypeKind::GeometryPolygon(), 11, '[UnknownType Nullable=TRUE SRID=11]'];
        $result[] = [PrimitiveTypeKind::GeometryCollection(), null, '[UnknownType Nullable=TRUE SRID=Variable]'];
        $result[] = [PrimitiveTypeKind::GeometryCollection(), 11, '[UnknownType Nullable=TRUE SRID=11]'];
        $result[] = [PrimitiveTypeKind::GeometryMultiPolygon(), null, '[UnknownType Nullable=TRUE SRID=Variable]'];
        $result[] = [PrimitiveTypeKind::GeometryMultiPolygon(), 11, '[UnknownType Nullable=TRUE SRID=11]'];
        $result[] = [PrimitiveTypeKind::GeometryMultiLineString(), null, '[UnknownType Nullable=TRUE SRID=Variable]'];
        $result[] = [PrimitiveTypeKind::GeometryMultiLineString(), 11, '[UnknownType Nullable=TRUE SRID=11]'];
        $result[] = [PrimitiveTypeKind::GeometryMultiPoint(), null, '[UnknownType Nullable=TRUE SRID=Variable]'];
        $result[] = [PrimitiveTypeKind::GeometryMultiPoint(), 11, '[UnknownType Nullable=TRUE SRID=11]'];

        return $result;
    }

    /**
     * @dataProvider spatialFacetProvider
     *
     * @param PrimitiveTypeKind $type
     * @param int|null          $srid
     * @param string            $expected
     */
    public function testTraceStringSpatialFacet(PrimitiveTypeKind $type, ?int $srid, string $expected)
    {
        $binRef = m::mock(ISpatialTypeReference::class)->makePartial();
        $binRef->shouldReceive('PrimitiveKind')->andReturn($type);
        $binRef->shouldReceive('AsSpatial')->andReturn($binRef);
        $binRef->shouldReceive('getSpatialReferenceIdentifier')->andReturn($srid);

        $element = m::mock(IEdmElement::class . ', ' . ITypeReference::class)->makePartial();
        $element->shouldReceive('FullName')->andReturn('FullName');
        $element->shouldReceive('isPrimitive')->andReturn(true);
        $element->shouldReceive('asPrimitive')->andReturn($binRef);
        $element->shouldReceive('getDefinition')->andReturn(null);
        $element->shouldReceive('getNullable')->andReturn(true);

        $actual = ToTraceString::ToTraceString($element);

        $this->assertEquals($expected, $actual);
    }
}
