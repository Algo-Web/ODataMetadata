<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Tests\Unit\Helpers;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;
use AlgoWeb\ODataMetadata\Enums\PrimitiveTypeKind;
use AlgoWeb\ODataMetadata\Interfaces\ICheckable;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveType;
use AlgoWeb\ODataMetadata\Interfaces\IRowType;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaElement;
use AlgoWeb\ODataMetadata\Interfaces\IType;
use AlgoWeb\ODataMetadata\Library\EdmPrimitiveTypeReference;
use AlgoWeb\ODataMetadata\Library\EdmRowTypeReference;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\BadBinaryTypeReference;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\BadDecimalTypeReference;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\BadNamedStructuredType;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\BadPrimitiveTypeReference;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\BadSpatialTypeReference;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\BadStringTypeReference;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\BadTemporalTypeReference;
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
        $row    = IRowType::class;
        $schema = ISchemaElement::class;

        $def = m::mock($row . ', ' . $schema)->makePartial();
        $def->shouldReceive('FullName')->andReturn('FullName');
        $this->assertTrue($def instanceof ISchemaElement);

        $foo = new EdmRowTypeReference($def, false);

        $expected = 'FullName';
        $actual   = $foo->FullName();

        $this->assertEquals($expected, $actual);
    }

    public function testPrimitiveKindWhenDefinitionNull()
    {
        $def = null;
        $foo = new EdmRowTypeReference($def, false);

        $expected = PrimitiveTypeKind::None();
        $actual   = $foo->PrimitiveKind();

        $this->assertEquals($expected, $actual);
    }

    public function testPrimitiveKindWhenDefinitionNotPrimitive()
    {
        $def = m::mock(IRowType::class);
        $def->shouldReceive('getTypeKind->isPrimitive')->andReturn(false);

        $foo = new EdmRowTypeReference($def, false);

        $expected = PrimitiveTypeKind::None();
        $actual   = $foo->PrimitiveKind();

        $this->assertEquals($expected, $actual);
    }

    public function testPrimitiveKindWhenDefinitionPrimitive()
    {
        $def = m::mock(IRowType::class . ', ' . IPrimitiveType::class);
        $def->shouldReceive('getTypeKind->isPrimitive')->andReturn(true);
        $def->shouldReceive('getPrimitiveKind')->andReturn(PrimitiveTypeKind::Boolean());

        $foo = new EdmRowTypeReference($def, false);

        $expected = PrimitiveTypeKind::Boolean();
        $actual   = $foo->PrimitiveKind();

        $this->assertEquals($expected, $actual);
    }

    public function typeKindCheckProvider(): array
    {
        $result   = [];
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
        $actual   = $foo->{$function}();

        $this->assertEquals($expected, $actual);
    }

    public function primitiveKindCheckProvider(): array
    {
        $result   = [];
        $result[] = ['IsBinary'];
        $result[] = ['IsBoolean'];
        $result[] = ['IsTemporal'];
        $result[] = ['IsDateTime'];
        $result[] = ['IsDateTimeOffset'];
        $result[] = ['IsTime'];
        $result[] = ['IsRow'];
        $result[] = ['IsStructured'];
        $result[] = ['IsPrimitive'];
        $result[] = ['IsDecimal'];
        $result[] = ['IsFloating'];
        $result[] = ['IsSingle'];
        $result[] = ['IsDouble'];
        $result[] = ['IsGuid'];
        $result[] = ['IsSignedIntegral'];
        $result[] = ['IsSByte'];
        $result[] = ['IsInt16'];
        $result[] = ['IsInt32'];
        $result[] = ['IsInt64'];
        $result[] = ['IsIntegral'];
        $result[] = ['IsByte'];
        $result[] = ['IsString'];
        $result[] = ['IsStream'];
        $result[] = ['IsSpatial'];

        return $result;
    }

    /**
     * @dataProvider primitiveKindCheckProvider
     *
     * @param string $function
     */
    public function testPrimitiveKindCheck(string $function)
    {
        $foo = new EdmRowTypeReference(null, false);

        $expected = false;
        $actual   = $foo->{$function}();

        $this->assertEquals($expected, $actual);
    }

    public function testAsPrimitiveNullDefinition()
    {
        $foo = new EdmRowTypeReference(null, false);

        $actual = $foo->AsPrimitive();
        $this->assertTrue($actual instanceof BadPrimitiveTypeReference);
        $errors = $actual->getErrors();
        $this->assertEquals(1, count($errors));
        /** @var EdmError $error */
        $error    = $errors[0];
        $expected = 'The type \'UnnamedType\' could not be converted to be a \'Primitive\' type.';
        $actual   = $error->getErrorMessage();
        $this->assertEquals($expected, $actual);
        $this->assertEquals(230, $error->getErrorCode()->getValue());
    }

    public function testAsPrimitiveNoneDefinition()
    {
        $def = m::mock(IRowType::class . ', ' . IPrimitiveType::class . ', ' . ICheckable::class);
        $def->shouldReceive('getTypeKind->isPrimitive')->andReturn(true);
        $def->shouldReceive('getPrimitiveKind')->andReturn(PrimitiveTypeKind::None());
        $def->shouldReceive('getErrors')->andReturn([])->once();
        $def->shouldReceive('FullName')->andReturn('FullName');

        $foo = new EdmRowTypeReference($def, false);

        $actual = $foo->AsPrimitive();
        $this->assertTrue($actual instanceof BadPrimitiveTypeReference);
        $errors = $actual->getErrors();
        $this->assertEquals(1, count($errors));
        /** @var EdmError $error */
        $error    = $errors[0];
        $expected = 'The type \'FullName\' could not be converted to be a \'Primitive\' type.';
        $actual   = $error->getErrorMessage();
        $this->assertEquals($expected, $actual);
        $this->assertEquals(230, $error->getErrorCode()->getValue());
    }

    public function testAsPrimitiveBinaryDefinition()
    {
        $def = m::mock(IRowType::class . ', ' . IPrimitiveType::class . ', ' . ICheckable::class);
        $def->shouldReceive('getTypeKind->isPrimitive')->andReturn(true);
        $def->shouldReceive('getPrimitiveKind')->andReturn(PrimitiveTypeKind::Binary());
        $def->shouldReceive('getErrors')->andReturn([])->once();
        $def->shouldReceive('FullName')->andReturn('FullName');

        $foo = new EdmRowTypeReference($def, false);

        $actual = $foo->AsPrimitive();
        $this->assertTrue($actual instanceof BadBinaryTypeReference);
        $errors = $actual->getErrors();
        $this->assertEquals(1, count($errors));
        /** @var EdmError $error */
        $error    = $errors[0];
        $expected = 'The type \'FullName\' could not be converted to be a \'Binary\' type.';
        $actual   = $error->getErrorMessage();
        $this->assertEquals($expected, $actual);
        $this->assertEquals(230, $error->getErrorCode()->getValue());
    }

    public function testAsPrimitiveDecimalDefinition()
    {
        $def = m::mock(IRowType::class . ', ' . IPrimitiveType::class . ', ' . ICheckable::class);
        $def->shouldReceive('getTypeKind->isPrimitive')->andReturn(true);
        $def->shouldReceive('getPrimitiveKind')->andReturn(PrimitiveTypeKind::Decimal());
        $def->shouldReceive('getErrors')->andReturn([])->once();
        $def->shouldReceive('FullName')->andReturn('FullName');

        $foo = new EdmRowTypeReference($def, false);

        $actual = $foo->AsPrimitive();
        $this->assertTrue($actual instanceof BadDecimalTypeReference);
        $errors = $actual->getErrors();
        $this->assertEquals(1, count($errors));
        /** @var EdmError $error */
        $error    = $errors[0];
        $expected = 'The type \'FullName\' could not be converted to be a \'Decimal\' type.';
        $actual   = $error->getErrorMessage();
        $this->assertEquals($expected, $actual);
        $this->assertEquals(230, $error->getErrorCode()->getValue());
    }

    public function testAsPrimitiveStringDefinition()
    {
        $def = m::mock(IRowType::class . ', ' . IPrimitiveType::class . ', ' . ICheckable::class);
        $def->shouldReceive('getTypeKind->isPrimitive')->andReturn(true);
        $def->shouldReceive('getPrimitiveKind')->andReturn(PrimitiveTypeKind::String());
        $def->shouldReceive('getErrors')->andReturn([])->once();
        $def->shouldReceive('FullName')->andReturn('FullName');

        $foo = new EdmRowTypeReference($def, false);

        $actual = $foo->AsPrimitive();
        $this->assertTrue($actual instanceof BadStringTypeReference);
        $errors = $actual->getErrors();
        $this->assertEquals(1, count($errors));
        /** @var EdmError $error */
        $error    = $errors[0];
        $expected = 'The type \'FullName\' could not be converted to be a \'String\' type.';
        $actual   = $error->getErrorMessage();
        $this->assertEquals($expected, $actual);
        $this->assertEquals(230, $error->getErrorCode()->getValue());
    }

    public function asPrimitivePrimitiveTypeProvider(): array
    {
        $result   = [];
        $result[] = [PrimitiveTypeKind::Boolean()];
        $result[] = [PrimitiveTypeKind::Byte()];
        $result[] = [PrimitiveTypeKind::Double()];
        $result[] = [PrimitiveTypeKind::Guid()];
        $result[] = [PrimitiveTypeKind::Int16()];
        $result[] = [PrimitiveTypeKind::Int32()];
        $result[] = [PrimitiveTypeKind::Int64()];
        $result[] = [PrimitiveTypeKind::SByte()];
        $result[] = [PrimitiveTypeKind::Single()];
        $result[] = [PrimitiveTypeKind::Stream()];

        return $result;
    }

    /**
     * @dataProvider asPrimitivePrimitiveTypeProvider
     *
     * @param PrimitiveTypeKind $type
     */
    public function testAsPrimitivePrimitiveDefinition(PrimitiveTypeKind $type)
    {
        $def = m::mock(IRowType::class . ', ' . IPrimitiveType::class . ', ' . ICheckable::class);
        $def->shouldReceive('getTypeKind->isPrimitive')->andReturn(true);
        $def->shouldReceive('getPrimitiveKind')->andReturn($type);
        $def->shouldReceive('getErrors')->andReturn([])->once();

        $foo = new EdmRowTypeReference($def, false);

        $actual = $foo->AsPrimitive();
        $this->assertTrue($actual instanceof EdmPrimitiveTypeReference);
        $def  = $actual->getDefinition();
        $kind = $def->getPrimitiveKind();
        $this->assertEquals($type, $kind);
    }

    public function asPrimitiveSpatialTypeProvider(): array
    {
        $result   = [];
        $result[] = [PrimitiveTypeKind::Geography()];
        $result[] = [PrimitiveTypeKind::GeographyPoint()];
        $result[] = [PrimitiveTypeKind::GeographyLineString()];
        $result[] = [PrimitiveTypeKind::GeographyPolygon()];
        $result[] = [PrimitiveTypeKind::GeographyCollection()];
        $result[] = [PrimitiveTypeKind::GeographyMultiPoint()];
        $result[] = [PrimitiveTypeKind::GeographyMultiLineString()];
        $result[] = [PrimitiveTypeKind::GeographyMultiPolygon()];
        $result[] = [PrimitiveTypeKind::Geometry()];
        $result[] = [PrimitiveTypeKind::GeometryPoint()];
        $result[] = [PrimitiveTypeKind::GeometryLineString()];
        $result[] = [PrimitiveTypeKind::GeometryPolygon()];
        $result[] = [PrimitiveTypeKind::GeometryCollection()];
        $result[] = [PrimitiveTypeKind::GeometryMultiPolygon()];
        $result[] = [PrimitiveTypeKind::GeometryMultiLineString()];
        $result[] = [PrimitiveTypeKind::GeometryMultiPoint()];

        return $result;
    }

    /**
     * @dataProvider asPrimitiveSpatialTypeProvider
     *
     * @param PrimitiveTypeKind $type
     */
    public function testAsPrimitiveSpatialDefinition(PrimitiveTypeKind $type)
    {
        $def = m::mock(IRowType::class . ', ' . IPrimitiveType::class . ', ' . ICheckable::class);
        $def->shouldReceive('getTypeKind->isPrimitive')->andReturn(true);
        $def->shouldReceive('getPrimitiveKind')->andReturn($type);
        $def->shouldReceive('getErrors')->andReturn([])->once();
        $def->shouldReceive('FullName')->andReturn('FullName');

        $foo = new EdmRowTypeReference($def, false);

        $actual = $foo->AsPrimitive();
        $this->assertTrue($actual instanceof BadSpatialTypeReference);
        $errors = $actual->getErrors();
        $this->assertEquals(1, count($errors));
        /** @var EdmError $error */
        $error    = $errors[0];
        $expected = 'The type \'FullName\' could not be converted to be a \'Spatial\' type.';
        $actual   = $error->getErrorMessage();
        $this->assertEquals($expected, $actual);
        $this->assertEquals(230, $error->getErrorCode()->getValue());
    }

    public function asPrimitiveTemporalTypeProvider(): array
    {
        $result   = [];
        $result[] = [PrimitiveTypeKind::Time()];
        $result[] = [PrimitiveTypeKind::DateTime()];
        $result[] = [PrimitiveTypeKind::DateTimeOffset()];

        return $result;
    }
    /**
     * @dataProvider asPrimitiveTemporalTypeProvider
     *
     * @param PrimitiveTypeKind $type
     */
    public function testAsPrimitiveTemporalDefinition(PrimitiveTypeKind $type)
    {
        $def = m::mock(IRowType::class . ', ' . IPrimitiveType::class . ', ' . ICheckable::class);
        $def->shouldReceive('getTypeKind->isPrimitive')->andReturn(true);
        $def->shouldReceive('getPrimitiveKind')->andReturn($type);
        $def->shouldReceive('getErrors')->andReturn([])->once();
        $def->shouldReceive('FullName')->andReturn('FullName');

        $foo = new EdmRowTypeReference($def, false);

        $actual = $foo->AsPrimitive();
        $this->assertTrue($actual instanceof BadTemporalTypeReference);
        $errors = $actual->getErrors();
        $this->assertEquals(1, count($errors));
        /** @var EdmError $error */
        $error    = $errors[0];
        $expected = 'The type \'FullName\' could not be converted to be a \'Temporal\' type.';
        $actual   = $error->getErrorMessage();
        $this->assertEquals($expected, $actual);
        $this->assertEquals(230, $error->getErrorCode()->getValue());
    }
}
