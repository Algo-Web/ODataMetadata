<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 29/06/20
 * Time: 11:26 PM
 */

namespace AlgoWeb\ODataMetadata\Tests\Unit\Helpers;

use AlgoWeb\ODataMetadata\Enums\PrimitiveTypeKind;
use AlgoWeb\ODataMetadata\Exception\InvalidOperationException;
use AlgoWeb\ODataMetadata\Helpers\EdmTypeSemantics;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveType;
use AlgoWeb\ODataMetadata\Library\EdmBinaryTypeReference;
use AlgoWeb\ODataMetadata\Library\EdmDecimalTypeReference;
use AlgoWeb\ODataMetadata\Library\EdmPrimitiveTypeReference;
use AlgoWeb\ODataMetadata\Library\EdmSpatialTypeReference;
use AlgoWeb\ODataMetadata\Library\EdmStringTypeReference;
use AlgoWeb\ODataMetadata\Library\EdmTemporalTypeReference;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class EdmTypeSemanticsTest extends TestCase
{
    public function primitiveTypeReferenceProvider(): array
    {
        $result = [];
        $result[] = [PrimitiveTypeKind::Boolean(), EdmPrimitiveTypeReference::class];
        $result[] = [PrimitiveTypeKind::Byte(), EdmPrimitiveTypeReference::class];
        $result[] = [PrimitiveTypeKind::Double(), EdmPrimitiveTypeReference::class];
        $result[] = [PrimitiveTypeKind::Guid(), EdmPrimitiveTypeReference::class];
        $result[] = [PrimitiveTypeKind::Int16(), EdmPrimitiveTypeReference::class];
        $result[] = [PrimitiveTypeKind::Int32(), EdmPrimitiveTypeReference::class];
        $result[] = [PrimitiveTypeKind::Int64(), EdmPrimitiveTypeReference::class];
        $result[] = [PrimitiveTypeKind::SByte(), EdmPrimitiveTypeReference::class];
        $result[] = [PrimitiveTypeKind::Single(), EdmPrimitiveTypeReference::class];
        $result[] = [PrimitiveTypeKind::Stream(), EdmPrimitiveTypeReference::class];
        $result[] = [PrimitiveTypeKind::Binary(), EdmBinaryTypeReference::class];
        $result[] = [PrimitiveTypeKind::String(), EdmStringTypeReference::class];
        $result[] = [PrimitiveTypeKind::Decimal(), EdmDecimalTypeReference::class];
        $result[] = [PrimitiveTypeKind::DateTime(), EdmTemporalTypeReference::class];
        $result[] = [PrimitiveTypeKind::DateTimeOffset(), EdmTemporalTypeReference::class];
        $result[] = [PrimitiveTypeKind::Time(), EdmTemporalTypeReference::class];
        $result[] = [PrimitiveTypeKind::Geography(), EdmSpatialTypeReference::class];
        $result[] = [PrimitiveTypeKind::GeographyPoint(), EdmSpatialTypeReference::class];
        $result[] = [PrimitiveTypeKind::GeographyLineString(), EdmSpatialTypeReference::class];
        $result[] = [PrimitiveTypeKind::GeographyPolygon(), EdmSpatialTypeReference::class];
        $result[] = [PrimitiveTypeKind::GeographyCollection(), EdmSpatialTypeReference::class];
        $result[] = [PrimitiveTypeKind::GeographyMultiPolygon(), EdmSpatialTypeReference::class];
        $result[] = [PrimitiveTypeKind::GeographyMultiLineString(), EdmSpatialTypeReference::class];
        $result[] = [PrimitiveTypeKind::GeographyMultiPoint(), EdmSpatialTypeReference::class];
        $result[] = [PrimitiveTypeKind::Geometry(), EdmSpatialTypeReference::class];
        $result[] = [PrimitiveTypeKind::GeometryPoint(), EdmSpatialTypeReference::class];
        $result[] = [PrimitiveTypeKind::GeometryLineString(), EdmSpatialTypeReference::class];
        $result[] = [PrimitiveTypeKind::GeometryPolygon(), EdmSpatialTypeReference::class];
        $result[] = [PrimitiveTypeKind::GeometryCollection(), EdmSpatialTypeReference::class];
        $result[] = [PrimitiveTypeKind::GeometryMultiPolygon(), EdmSpatialTypeReference::class];
        $result[] = [PrimitiveTypeKind::GeometryMultiLineString(), EdmSpatialTypeReference::class];
        $result[] = [PrimitiveTypeKind::GeometryMultiPoint(), EdmSpatialTypeReference::class];

        return $result;
    }

    /**
     * @dataProvider primitiveTypeReferenceProvider
     *
     * @param PrimitiveTypeKind $kind
     * @param string $expectedClass
     */
    public function testGetPrimitiveTypeReference(PrimitiveTypeKind $kind, string $expectedClass)
    {
        $primType = m::mock(IPrimitiveType::class);
        $primType->shouldReceive('getPrimitiveKind')->andReturn($kind);

        $result = EdmTypeSemantics::GetPrimitiveTypeReference($primType, false);
        $this->assertTrue($result instanceof $expectedClass);
    }

    public function testGetPrimitiveTypeReferenceNoGood()
    {
        $primType = m::mock(IPrimitiveType::class);
        $primType->shouldReceive('getPrimitiveKind')->andReturn(PrimitiveTypeKind::None());

        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('Unexpected primitive type kind.');

        EdmTypeSemantics::GetPrimitiveTypeReference($primType, false);
    }
}
