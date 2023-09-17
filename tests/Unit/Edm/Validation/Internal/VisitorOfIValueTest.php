<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 9/07/20
 * Time: 12:55 AM.
 */

namespace AlgoWeb\ODataMetadata\Tests\Unit\Edm\Validation\Internal;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;
use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator\VisitorOfIValue;
use AlgoWeb\ODataMetadata\Enums\ValueKind;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaElement;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
use AlgoWeb\ODataMetadata\Interfaces\Values\IBinaryValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\IBooleanValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\ICollectionValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\IDateTimeOffsetValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\IDateTimeValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\IDecimalValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\IEnumValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\IFloatingValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\IGuidValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\IIntegerValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\INullValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\IStringValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\IStructuredValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\ITimeValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\IValue;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class VisitorOfIValueTest extends TestCase
{
    public function schemaElementKindProvider(): array
    {
        $result   = [];
        $result[] = [ValueKind::Binary(), IBinaryValue::class];
        $result[] = [ValueKind::Boolean(), IBooleanValue::class];
        $result[] = [ValueKind::Collection(), ICollectionValue::class];
        $result[] = [ValueKind::DateTime(), IDateTimeValue::class];
        $result[] = [ValueKind::DateTimeOffset(), IDateTimeOffsetValue::class];
        $result[] = [ValueKind::Decimal(), IDecimalValue::class];
        $result[] = [ValueKind::Enum(), IEnumValue::class];
        $result[] = [ValueKind::Floating(), IFloatingValue::class];
        $result[] = [ValueKind::Guid(), IGuidValue::class];
        $result[] = [ValueKind::Integer(), IIntegerValue::class];
        $result[] = [ValueKind::Null(), INullValue::class];
        $result[] = [ValueKind::String(), IStringValue::class];
        $result[] = [Valuekind::Structured(), IStructuredValue::class];
        $result[] = [ValueKind::Time(), ITimeValue::class];

        return $result;
    }
    /**
     * @dataProvider schemaElementKindProvider
     *
     * @param ValueKind $kind
     * @param string    $mustImplement
     */
    public function testVisitGoodValueKindNonNullNamespace(ValueKind $kind, string $mustImplement)
    {
        $type = m::mock(ITypeReference::class);

        $item = m::mock(IValue::class)->makePartial();
        $item->shouldReceive('getNamespace')->andReturn('namespace')->atLeast(1);
        $item->shouldReceive('getValueKind')->andReturn($kind)->atLeast(1);
        $item->shouldReceive('getType')->andReturn($type);

        $foo        = new VisitorOfIValue();
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
        $this->assertEquals(1, count($followUp));
    }

    public function testVisitBadValueKindNullNamespace()
    {
        $type = null;
        $kind = m::mock(ValueKind::class);
        $kind->shouldReceive('getKey')->andReturn('FAIL');
        $kind->shouldReceive('getValue')->andReturn(null);

        $item = m::mock(IValue::class)->makePartial();
        $item->shouldReceive('getNamespace')->andReturn('namespace')->atLeast(1);
        $item->shouldReceive('getValueKind')->andReturn($kind)->atLeast(1);
        $item->shouldReceive('getType')->andReturn($type);

        $foo        = new VisitorOfIValue();
        $followUp   = [];
        $references = [];

        $result = $foo->visit($item, $followUp, $references);
        $this->assertTrue(is_array($result));
        $this->assertEquals(1, count($result));
        /** @var EdmError $error */
        $error = $result[0];

        $errorCode = EdmErrorCode::InterfaceCriticalKindValueUnexpected();
        $this->assertEquals($errorCode, $error->getErrorCode());
        $expected = 'A semantically valid model must not contain elements of kind \'FAIL\'.';
        $this->assertStringContainsString($expected, $error->getErrorMessage());
        $this->assertEquals(0, count($followUp));
    }

    public function testVisitGoodValueKindNoneNullNamespace()
    {
        $type = null;
        $kind = ValueKind::None();

        $item = m::mock(IValue::class)->makePartial();
        $item->shouldReceive('getNamespace')->andReturn('namespace')->atLeast(1);
        $item->shouldReceive('getValueKind')->andReturn($kind)->atLeast(1);
        $item->shouldReceive('getType')->andReturn($type);

        $foo        = new VisitorOfIValue();
        $followUp   = [];
        $references = [];

        $result = $foo->visit($item, $followUp, $references);
        $this->assertTrue(is_array($result));
        $this->assertEquals(0, count($result));

        $this->assertEquals(0, count($followUp));
    }
}
