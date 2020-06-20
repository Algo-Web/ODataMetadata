<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 21/06/20
 * Time: 2:42 AM
 */

namespace AlgoWeb\ODataMetadata\Tests\Unit\Helpers;

use AlgoWeb\ODataMetadata\Helpers\ToTraceString;
use AlgoWeb\ODataMetadata\Interfaces\ICollectionType;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntityReferenceType;
use AlgoWeb\ODataMetadata\Interfaces\IEntityType;
use AlgoWeb\ODataMetadata\Interfaces\IProperty;
use AlgoWeb\ODataMetadata\Interfaces\IRowType;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaElement;
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
        $actual = ToTraceString::ToTraceString($element);

        $this->assertEquals($expected, $actual);
    }

    public function testTraceStringDefaultElement()
    {
        $element = m::mock(IEdmElement::class)->makePartial();
        $element->shouldReceive('FullName')->andReturn('FullName');

        $expected = 'UnknownType';
        $actual = ToTraceString::ToTraceString($element);

        $this->assertEquals($expected, $actual);
    }

    public function testTraceStringPropertyElementNoType()
    {
        $element = m::mock(IEdmElement::class . ', ' . IProperty::class)->makePartial();
        $element->shouldReceive('getType')->andReturn(null);
        $element->shouldReceive('getName')->andReturn('Name');

        $expected = 'Name';
        $actual = ToTraceString::ToTraceString($element);

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
        $actual = ToTraceString::ToTraceString($element);

        $this->assertEquals($expected, $actual);
    }

    public function testTraceStringEntityReferenceElementNullType()
    {
        $element = m::mock(IEdmElement::class . ', ' . IEntityReferenceType::class)->makePartial();
        $element->shouldReceive('getEntityType')->andReturn(null);

        $expected = 'EntityReference()';
        $actual = ToTraceString::ToTraceString($element);

        $this->assertEquals($expected, $actual);
    }

    public function testTraceStringEntityReferenceElementHasType()
    {
        $eType = m::mock(IEntityType::class)->makePartial();
        $eType->shouldReceive('FullName')->andReturn('FullName');

        $element = m::mock(IEdmElement::class . ', ' . IEntityReferenceType::class)->makePartial();
        $element->shouldReceive('getEntityType')->andReturn($eType);

        $expected = 'EntityReference(FullName)';
        $actual = ToTraceString::ToTraceString($element);

        $this->assertEquals($expected, $actual);
    }

    public function testTraceStringEntityCollectionElementNullType()
    {
        $element = m::mock(IEdmElement::class . ', ' . ICollectionType::class)->makePartial();
        $element->shouldReceive('getElementType')->andReturn(null);

        $expected = 'Collection()';
        $actual = ToTraceString::ToTraceString($element);

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
        $actual = ToTraceString::ToTraceString($element);

        $this->assertEquals($expected, $actual);
    }

    public function testTraceStringRowType()
    {
        $prop1 = m::mock(IEdmElement::class . ', ' . ISchemaElement::class)->makePartial();
        $prop1->shouldReceive('FullName')->andReturn('FullName');

        $element = m::mock(IEdmElement::class . ', ' . IRowType::class)->makePartial();
        $element->shouldReceive('Properties')->andReturn([$prop1, null]);

        $expected = 'Row(FullName)';
        $actual = ToTraceString::ToTraceString($element);

        $this->assertEquals($expected, $actual);
    }
}
