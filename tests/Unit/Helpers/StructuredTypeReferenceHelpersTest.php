<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 12/07/20
 * Time: 6:53 PM.
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

        $this->assertNotNull($foo->structuredDefinition());
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

        $this->assertEquals(false, $foo->isAbstract());
    }

    public function testIsAbstractStructuredDefinitionIsAbstract()
    {
        $type = m::mock(IComplexType::class);
        $type->shouldReceive('isAbstract')->andReturn(true)->atLeast(1);

        $foo = new EdmComplexTypeReference($type, true);

        $this->assertEquals(true, $foo->isAbstract());
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

        $this->assertEquals(false, $foo->isOpen());
    }

    public function testIsOpenStructuredDefinitionIsOpen()
    {
        $type = m::mock(IComplexType::class);
        $type->shouldReceive('IsOpen')->andReturn(true)->atLeast(1);

        $foo = new EdmComplexTypeReference($type, true);

        $this->assertEquals(true, $foo->isOpen());
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

        $this->assertEquals(null, $foo->baseType());
    }

    public function testBaseTypeStructuredDefinitionHasNotNullBaseType()
    {
        $type = m::mock(IComplexType::class);
        $type->shouldReceive('getBaseType')->andReturn($type)->atLeast(1);

        $foo = new EdmComplexTypeReference($type, true);

        $this->assertEquals($type, $foo->baseType());
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

        $this->assertEquals([], $foo->declaredStructuralProperties());
    }

    public function testDeclaredStructuralPropertiesStructuredDefinitionHasOneProperty()
    {
        $prop = m::mock(IStructuralProperty::class);

        $type = m::mock(IComplexType::class);
        $type->shouldReceive('DeclaredStructuralProperties')->andReturn([$prop])->atLeast(1);

        $foo = new EdmComplexTypeReference($type, true);

        $this->assertEquals([$prop], $foo->declaredStructuralProperties());
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

        $this->assertEquals([], $foo->structuralProperties());
    }

    public function testStructuralPropertiesStructuredDefinitionHasOneProperty()
    {
        $prop = m::mock(IStructuralProperty::class);

        $type = m::mock(IComplexType::class);
        $type->shouldReceive('StructuralProperties')->andReturn([$prop])->atLeast(1);

        $foo = new EdmComplexTypeReference($type, true);

        $this->assertEquals([$prop], $foo->structuralProperties());
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
