<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Tests\Unit\Helpers;

use AlgoWeb\ODataMetadata\Enums\PrimitiveTypeKind;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveType;
use AlgoWeb\ODataMetadata\Interfaces\IRowType;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaElement;
use AlgoWeb\ODataMetadata\Interfaces\IType;
use AlgoWeb\ODataMetadata\Library\EdmRowTypeReference;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\BadNamedStructuredType;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class TypeReferenceHelpersTest extends TestCase
{
    public function testFullNameNullDefinition()
    {
        $foo = new EdmRowTypeReference(null, false);

        $this->assertNull($foo->FullName());
    }

    public function testFullNameDefinitionNotISchemaElement()
    {
        $def = m::mock(IRowType::class)->makePartial();

        $foo = new EdmRowTypeReference($def, false);

        $this->assertNull($foo->FullName());
    }

    public function testFullNameDefinitionISchemaElement()
    {
        $row = IRowType::class;
        $schema = ISchemaElement::class;

        $def = m::mock($row . ', ' . $schema)->makePartial();
        $def->shouldReceive('FullName')->andReturn('FullName');
        $this->assertTrue($def instanceof ISchemaElement);

        $foo = new EdmRowTypeReference($def, false);

        $expected = 'FullName';
        $actual = $foo->FullName();

        $this->assertEquals($expected, $actual);
    }

    public function testPrimitiveKindWhenDefinitionNull()
    {
        $def = null;
        $foo = new EdmRowTypeReference($def, false);

        $expected = PrimitiveTypeKind::None();
        $actual = $foo->PrimitiveKind();

        $this->assertEquals($expected, $actual);
    }

    public function testPrimitiveKindWhenDefinitionNotPrimitive()
    {
        $def = m::mock(IRowType::class);
        $def->shouldReceive('getTypeKind->isPrimitive')->andReturn(false);

        $foo = new EdmRowTypeReference($def, false);

        $expected = PrimitiveTypeKind::None();
        $actual = $foo->PrimitiveKind();

        $this->assertEquals($expected, $actual);
    }

    public function testPrimitiveKindWhenDefinitionPrimitive()
    {
        $def = m::mock(IRowType::class . ', ' . IPrimitiveType::class);
        $def->shouldReceive('getTypeKind->isPrimitive')->andReturn(true);
        $def->shouldReceive('getPrimitiveKind')->andReturn(PrimitiveTypeKind::Boolean());

        $foo = new EdmRowTypeReference($def, false);

        $expected = PrimitiveTypeKind::Boolean();
        $actual = $foo->PrimitiveKind();

        $this->assertEquals($expected, $actual);
    }

    public function typeKindCheckProvider(): array
    {
        $result = [];
        $result[] = ['IsCollection'];
        $result[] = ['IsEntity'];
        $result[] = ['IsEntityReference'];
        $result[] = ['IsComplex'];
        $result[] = ['IsEnum'];
        $result[] = ['IsRow'];
        $result[] = ['IsStructured'];
        $result[] = ['IsPrimitive'];

        return $result;
    }

    /**
     * @dataProvider typeKindCheckProvider
     *
     * @param string $function
     */
    public function testTypeKindCheck(string $function)
    {
        $foo = new EdmRowTypeReference(null, false);

        $expected = false;
        $actual = $foo->{$function}();

        $this->assertEquals($expected, $actual);
    }
}
