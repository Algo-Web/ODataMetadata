<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 17/06/20
 * Time: 10:41 PM
 */

namespace AlgoWeb\ODataMetadata\Tests\Unit\Helpers;

use AlgoWeb\ODataMetadata\Enums\PrimitiveTypeKind;
use AlgoWeb\ODataMetadata\Exception\InvalidOperationException;
use AlgoWeb\ODataMetadata\Library\Core\EdmValidCoreModelPrimitiveType;
use AlgoWeb\ODataMetadata\Library\EdmBinaryTypeReference;
use AlgoWeb\ODataMetadata\Library\EdmDecimalTypeReference;
use AlgoWeb\ODataMetadata\Library\EdmPrimitiveTypeReference;
use AlgoWeb\ODataMetadata\Library\EdmSpatialTypeReference;
use AlgoWeb\ODataMetadata\Library\EdmStringTypeReference;
use AlgoWeb\ODataMetadata\Library\EdmTemporalTypeReference;
use AlgoWeb\ODataMetadata\Tests\TestCase;

class PrimitiveTypeHelpersTest extends TestCase
{
    public function asPrimitivePrimitiveTypeProvider(): array
    {
        $result = [];
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
    public function testGetPrimitiveTypeReferenceAsPrimitiveType(PrimitiveTypeKind $type)
    {
        $foo = new EdmValidCoreModelPrimitiveType('', '', $type);

        $actual = $foo->GetPrimitiveTypeReference(true);
        $this->assertTrue($actual instanceof EdmPrimitiveTypeReference);
        $def = $actual->getDefinition();
        $this->assertEquals($type, $def->getPrimitiveKind());
    }

    public function asPrimitiveSpatialTypeProvider(): array
    {
        $result = [];
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
    public function testGetPrimitiveTypeReferenceAsSpatialType(PrimitiveTypeKind $type)
    {
        $foo = new EdmValidCoreModelPrimitiveType('', '', $type);

        $actual = $foo->GetPrimitiveTypeReference(true);
        $this->assertTrue($actual instanceof EdmSpatialTypeReference);
        $def = $actual->getDefinition();
        $this->assertEquals($type, $def->getPrimitiveKind());
    }

    public function asPrimitiveTemporalTypeProvider(): array
    {
        $result = [];
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
    public function testGetPrimitiveTypeReferenceAsTemporalType(PrimitiveTypeKind $type)
    {
        $foo = new EdmValidCoreModelPrimitiveType('', '', $type);

        $actual = $foo->GetPrimitiveTypeReference(true);
        $this->assertTrue($actual instanceof EdmTemporalTypeReference);
        $def = $actual->getDefinition();
        $this->assertEquals($type, $def->getPrimitiveKind());
    }

    public function asPrimitiveMiscTypeProvider(): array
    {
        $result = [];
        $result[] = [PrimitiveTypeKind::Binary(), EdmBinaryTypeReference::class];
        $result[] = [PrimitiveTypeKind::String(), EdmStringTypeReference::class];
        $result[] = [PrimitiveTypeKind::Decimal(), EdmDecimalTypeReference::class];

        return $result;
    }

    /**
     * @dataProvider asPrimitiveMiscTypeProvider
     *
     * @param PrimitiveTypeKind $type
     */
    public function testGetPrimitiveTypeReferenceAsMiscType(PrimitiveTypeKind $type, string $expType)
    {
        $foo = new EdmValidCoreModelPrimitiveType('', '', $type);

        $actual = $foo->GetPrimitiveTypeReference(true);
        $this->assertTrue($actual instanceof $expType);
        $def = $actual->getDefinition();
        $this->assertEquals($type, $def->getPrimitiveKind());
    }

    public function testGetPrimitiveTypeBadType()
    {
        $type = PrimitiveTypeKind::None();
        $foo = new EdmValidCoreModelPrimitiveType('', '', $type);

        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('Unexpected primitive type kind.');

        $foo->GetPrimitiveTypeReference(true);
    }
}
