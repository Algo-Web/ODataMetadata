<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 12/07/20
 * Time: 6:53 PM
 */

namespace AlgoWeb\ODataMetadata\Tests\Unit\Helpers;

use AlgoWeb\ODataMetadata\Interfaces\IComplexType;
use AlgoWeb\ODataMetadata\Interfaces\IProperty;
use AlgoWeb\ODataMetadata\Interfaces\IStructuralProperty;
use AlgoWeb\ODataMetadata\Library\EdmComplexTypeReference;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class StructuredTypeReferenceHelpersTest extends TestCase
{
    public function testGetStructuredDefinitionNotNull()
    {
        $type = m::mock(IComplexType::class);

        $foo = new EdmComplexTypeReference($type, true);

        $this->assertNotNull($foo->StructuredDefinition());
    }

    public function testIsAbstractNullStructuredDefinition()
    {
        $foo = m::mock(EdmComplexTypeReference::class)->makePartial();
        $foo->shouldReceive('StructuredDefinition')->andReturn(null)->atLeast(1);

        $this->assertEquals(false, $foo->IsAbstract());
    }

    public function testIsAbstractStructuredDefinitionIsNotAbstract()
    {
        $type = m::mock(IComplexType::class);
        $type->shouldReceive('isAbstract')->andReturn(false)->atLeast(1);

        $foo = new EdmComplexTypeReference($type, true);

        $this->assertEquals(false, $foo->IsAbstract());
    }

    public function testIsAbstractStructuredDefinitionIsAbstract()
    {
        $type = m::mock(IComplexType::class);
        $type->shouldReceive('isAbstract')->andReturn(true)->atLeast(1);

        $foo = new EdmComplexTypeReference($type, true);

        $this->assertEquals(true, $foo->IsAbstract());
    }

    public function testIsOpenNullStructuredDefinition()
    {
        $foo = m::mock(EdmComplexTypeReference::class)->makePartial();
        $foo->shouldReceive('StructuredDefinition')->andReturn(null)->atLeast(1);

        $this->assertEquals(false, $foo->IsOpen());
    }

    public function testIsOpenStructuredDefinitionIsNotAbstract()
    {
        $type = m::mock(IComplexType::class);
        $type->shouldReceive('IsOpen')->andReturn(false)->atLeast(1);

        $foo = new EdmComplexTypeReference($type, true);

        $this->assertEquals(false, $foo->IsOpen());
    }

    public function testIsOpenStructuredDefinitionIsOpen()
    {
        $type = m::mock(IComplexType::class);
        $type->shouldReceive('IsOpen')->andReturn(true)->atLeast(1);

        $foo = new EdmComplexTypeReference($type, true);

        $this->assertEquals(true, $foo->IsOpen());
    }

    public function testBaseTypeNullStructuredDefinition()
    {
        $foo = m::mock(EdmComplexTypeReference::class)->makePartial();
        $foo->shouldReceive('StructuredDefinition')->andReturn(null)->atLeast(1);

        $this->assertEquals(false, $foo->BaseType());
    }

    public function testBaseTypeStructuredDefinitionHasNullBaseType()
    {
        $type = m::mock(IComplexType::class);
        $type->shouldReceive('getBaseType')->andReturn(null)->atLeast(1);

        $foo = new EdmComplexTypeReference($type, true);

        $this->assertEquals(null, $foo->BaseType());
    }

    public function testBaseTypeStructuredDefinitionHasNotNullBaseType()
    {
        $type = m::mock(IComplexType::class);
        $type->shouldReceive('getBaseType')->andReturn($type)->atLeast(1);

        $foo = new EdmComplexTypeReference($type, true);

        $this->assertEquals($type, $foo->BaseType());
    }

    public function testDeclaredStructuralPropertiesNullStructuredDefinition()
    {
        $foo = m::mock(EdmComplexTypeReference::class)->makePartial();
        $foo->shouldReceive('StructuredDefinition')->andReturn(null)->atLeast(1);

        $this->assertEquals([], $foo->DeclaredStructuralProperties());
    }

    public function testDeclaredStructuralPropertiesStructuredDefinitionHasNoProperties()
    {
        $type = m::mock(IComplexType::class);
        $type->shouldReceive('DeclaredStructuralProperties')->andReturn([])->atLeast(1);

        $foo = new EdmComplexTypeReference($type, true);

        $this->assertEquals([], $foo->DeclaredStructuralProperties());
    }

    public function testDeclaredStructuralPropertiesStructuredDefinitionHasOneProperty()
    {
        $prop = m::mock(IStructuralProperty::class);

        $type = m::mock(IComplexType::class);
        $type->shouldReceive('DeclaredStructuralProperties')->andReturn([$prop])->atLeast(1);

        $foo = new EdmComplexTypeReference($type, true);

        $this->assertEquals([$prop], $foo->DeclaredStructuralProperties());
    }

    public function testStructuralPropertiesNullStructuredDefinition()
    {
        $foo = m::mock(EdmComplexTypeReference::class)->makePartial();
        $foo->shouldReceive('StructuredDefinition')->andReturn(null)->atLeast(1);

        $this->assertEquals([], $foo->StructuralProperties());
    }

    public function testStructuralPropertiesStructuredDefinitionHasNoProperties()
    {
        $type = m::mock(IComplexType::class);
        $type->shouldReceive('StructuralProperties')->andReturn([])->atLeast(1);

        $foo = new EdmComplexTypeReference($type, true);

        $this->assertEquals([], $foo->StructuralProperties());
    }

    public function testStructuralPropertiesStructuredDefinitionHasOneProperty()
    {
        $prop = m::mock(IStructuralProperty::class);

        $type = m::mock(IComplexType::class);
        $type->shouldReceive('StructuralProperties')->andReturn([$prop])->atLeast(1);

        $foo = new EdmComplexTypeReference($type, true);

        $this->assertEquals([$prop], $foo->StructuralProperties());
    }

    public function testFindPropertyNullStructuredDefinition()
    {
        $foo = m::mock(EdmComplexTypeReference::class)->makePartial();
        $foo->shouldReceive('StructuredDefinition')->andReturn(null)->atLeast(1);

        $this->assertEquals(null, $foo->findProperty('name'));
    }

    public function testFindPropertyStructuredDefinitionNullProperty()
    {
        $type = m::mock(IComplexType::class);
        $type->shouldReceive('findProperty')->andReturn(null)->atLeast(1);

        $foo = new EdmComplexTypeReference($type, true);

        $this->assertEquals(null, $foo->findProperty('name'));
    }

    public function testFindPropertyStructuredDefinitionNonNullProperty()
    {
        $prop = m::mock(IProperty::class);

        $type = m::mock(IComplexType::class);
        $type->shouldReceive('findProperty')->withArgs(['name'])->andReturn($prop)->atLeast(1);

        $foo = new EdmComplexTypeReference($type, true);

        $this->assertEquals($prop, $foo->findProperty('name'));
    }
}
