<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 5/07/20
 * Time: 3:44 PM.
 */

namespace AlgoWeb\ODataMetadata\Tests\Unit\Edm\Validation\Internal;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;
use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator\VisitorOfISchemaElement;
use AlgoWeb\ODataMetadata\Enums\SchemaElementKind;
use AlgoWeb\ODataMetadata\Interfaces\IEntityContainer;
use AlgoWeb\ODataMetadata\Interfaces\IFunction;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaElement;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaType;
use AlgoWeb\ODataMetadata\Interfaces\IValueTerm;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class VisitorOfISchemaElementTest extends TestCase
{
    public function testVisitNullNamespace()
    {
        $item = m::mock(ISchemaElement::class)->makePartial();
        $item->shouldReceive('getNamespace')->andReturn(null)->atLeast(1);
        $item->shouldReceive('getSchemaElementKind')->andReturn(SchemaElementKind::None())->atLeast(1);

        $foo        = new VisitorOfISchemaElement();
        $followUp   = [];
        $references = [];

        $result = $foo->visit($item, $followUp, $references);
        $this->assertTrue(is_array($result));
        $this->assertEquals(1, count($result));
    }

    public function testVisitBadSchemaElementKindNonNullNamespace()
    {
        $item = m::mock(ISchemaElement::class)->makePartial();
        $item->shouldReceive('getNamespace')->andReturn('namespace')->atLeast(1);
        $item->shouldReceive('getSchemaElementKind')->andReturn(m::mock(SchemaElementKind::class)->makePartial())->atLeast(1);

        $foo        = new VisitorOfISchemaElement();
        $followUp   = [];
        $references = [];

        $result = $foo->visit($item, $followUp, $references);
        $this->assertTrue(is_array($result));
        $this->assertEquals(1, count($result));
        /** @var EdmError $error */
        $error = $result[0];

        $errorCode = EdmErrorCode::InterfaceCriticalEnumPropertyValueOutOfRange();
        $this->assertEquals($errorCode, $error->getErrorCode());
        $expected = 'that is not a valid enum member.';
        $this->assertStringContainsString($expected, $error->getErrorMessage());
    }

    public function schemaElementKindProvider(): array
    {
        $result   = [];
        $result[] = [SchemaElementKind::TypeDefinition(), ISchemaType::class];
        $result[] = [SchemaElementKind::Function(), IFunction::class];
        $result[] = [SchemaElementKind::ValueTerm(), IValueTerm::class];
        $result[] = [SchemaElementKind::EntityContainer(), IEntityContainer::class];

        return $result;
    }

    /**
     * @dataProvider schemaElementKindProvider
     *
     * @param SchemaElementKind $kind
     * @param string            $mustImplement
     */
    public function testVisitGoodSchemaElementKindNonNullNamespace(SchemaElementKind $kind, string $mustImplement)
    {
        $item = m::mock(ISchemaElement::class)->makePartial();
        $item->shouldReceive('getNamespace')->andReturn('namespace')->atLeast(1);
        $item->shouldReceive('getSchemaElementKind')->andReturn($kind)->atLeast(1);

        $foo        = new VisitorOfISchemaElement();
        $followUp   = [];
        $references = [];

        $result = $foo->visit($item, $followUp, $references);
        $this->assertTrue(is_array($result));
        $this->assertEquals(1, count($result));
        /** @var EdmError $error */
        $error = $result[0];

        $errorCode = EdmErrorCode::InterfaceCriticalKindValueMismatch();
        $this->assertEquals($errorCode, $error->getErrorCode());
        $expected = 'property must implement \'' . $mustImplement . '\' interface.';
        $this->assertStringContainsString($expected, $error->getErrorMessage());
    }
}
