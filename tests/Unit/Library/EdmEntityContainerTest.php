<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Tests\Unit\Library;

use AlgoWeb\ODataMetadata\Enums\ContainerElementKind;
use AlgoWeb\ODataMetadata\Exception\InvalidOperationException;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IEntitySetReferenceExpression;
use AlgoWeb\ODataMetadata\Interfaces\IEntityContainerElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntityType;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
use AlgoWeb\ODataMetadata\Library\EdmEntityContainer;
use AlgoWeb\ODataMetadata\Library\EdmFunctionImport;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class EdmEntityContainerTest extends TestCase
{
    public function testFindMissingEntitySet()
    {
        $foo = new EdmEntityContainer('Full', 'Name');

        $expected = null;
        $actual   = $foo->findEntitySet('set');
        $this->assertEquals($expected, $actual);
    }

    public function testFindPresentEntitySet()
    {
        $foo = new EdmEntityContainer('Full', 'Name');

        $type     = m::mock(IEntityType::class)->makePartial();
        $expected = $foo->addEntitySet('set', $type);
        $actual   = $foo->findEntitySet('set');
        $this->assertEquals($expected, $actual);
    }

    public function testFindFunctionImportMissing()
    {
        $foo = new EdmEntityContainer('Full', 'Name');

        $expected = [];
        $actual   = $foo->findFunctionImports('function');
        $this->assertEquals($expected, $actual);
    }

    public function testFindFunctionImportPresent()
    {
        $foo = new EdmEntityContainer('Full', 'Name');

        $typeRef   = m::mock(ITypeReference::class)->makePartial();
        $entitySet = m::mock(IEntitySetReferenceExpression::class)->makePartial();

        $expected = $foo->addFunctionImport('function', $typeRef, $entitySet, null, null, null);
        $this->assertTrue($expected instanceof EdmFunctionImport);
        $actual = $foo->findFunctionImports('function');
        $this->assertEquals([$expected], $actual);
    }

    public function testAddElementWithElementKindNone()
    {
        $foo = new EdmEntityContainer('Full', 'Name');

        $kind    = ContainerElementKind::None();
        $element = m::mock(IEntityContainerElement::class)->makePartial();
        $element->shouldReceive('getContainerElementKind')->andReturn($kind);
        $element->shouldReceive('getName')->andReturn('Name');

        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('An element with type \'None\' cannot be used in an entity container.');

        $foo->addElement($element);
    }

    public function testAddElementWithElementKindBad()
    {
        $foo = new EdmEntityContainer('Full', 'Name');

        $kind = m::mock(ContainerElementKind::class);
        $kind->shouldReceive('getKey')->andReturn('key');
        $element = m::mock(IEntityContainerElement::class)->makePartial();
        $element->shouldReceive('getContainerElementKind')->andReturn($kind);
        $element->shouldReceive('getName')->andReturn('Name');

        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('Invalid container element kind: \'key\'');

        $foo->addElement($element);
    }

    public function testAddElementWithElementNameNull()
    {
        $foo = new EdmEntityContainer('Full', 'Name');

        $kind = m::mock(ContainerElementKind::class);
        $kind->shouldReceive('getKey')->andReturn('key');
        $element = m::mock(IEntityContainerElement::class)->makePartial();
        $element->shouldReceive('getContainerElementKind')->andReturn($kind);
        $element->shouldReceive('getName')->andReturn(null);

        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('The name is missing or not valid.');

        $foo->addElement($element);
    }
}
