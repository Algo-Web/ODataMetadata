<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 24/06/20
 * Time: 2:28 AM.
 */
namespace AlgoWeb\ODataMetadata\Tests\Unit\Library\Values;

use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Enums\ValueKind;
use AlgoWeb\ODataMetadata\Exception\InvalidOperationException;
use AlgoWeb\ODataMetadata\Interfaces\ICollectionTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IEnumMember;
use AlgoWeb\ODataMetadata\Interfaces\IEnumTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveType;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\Values\IPrimitiveValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\IPropertyValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\IValue;
use AlgoWeb\ODataMetadata\Library\Values\EdmCollectionValue;
use AlgoWeb\ODataMetadata\Library\Values\EdmEnumValue;
use AlgoWeb\ODataMetadata\Library\Values\EdmNullExpression;
use AlgoWeb\ODataMetadata\Library\Values\EdmPropertyValue;
use AlgoWeb\ODataMetadata\Library\Values\EdmStructuredValue;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class ValuesTest extends TestCase
{
    public function testCollectionValue()
    {
        $type = m::mock(ICollectionTypeReference::class)->makePartial();
        $foo  = new EdmCollectionValue($type, []);

        $this->assertEquals(ValueKind::Collection(), $foo->getValueKind());
        $this->assertEquals([], $foo->getElements());
        $this->assertEquals($type, $foo->getType());
        $this->assertEquals($foo, $foo->getValue());
    }

    public function testEnumValue()
    {
        $type = m::mock(IEnumTypeReference::class)->makePartial();

        $primVal = m::mock(IPrimitiveValue::class)->makePartial();
        $value   = m::mock(IEnumMember::class)->makePartial();
        $value->shouldReceive('getValue')->andReturn($primVal);

        $foo = new EdmEnumValue($value, $type);
        $this->assertEquals(ValueKind::Enum(), $foo->getValueKind());
        $this->assertEquals($primVal, $foo->getValue());
    }

    public function testPropertyValueUpfront()
    {
        $value = m::mock(IValue::class)->makePartial();

        $foo = new EdmPropertyValue('property', $value);
        $this->assertEquals($value, $foo->getValue());
        $this->assertEquals('property', $foo->getName());
    }

    public function testPropertyValueAlreadySetGoesKaboomOnSet()
    {
        $value = m::mock(IValue::class)->makePartial();

        $foo = new EdmPropertyValue('property', $value);
        $this->assertEquals($value, $foo->getValue());

        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('Value has already been set');

        $foo->setValue($value);
    }

    public function testPropertyValueNotSet()
    {
        $value = m::mock(IValue::class)->makePartial();

        $foo = new EdmPropertyValue('property');
        $this->assertEquals(null, $foo->getValue());

        $foo->setValue($value);
        $this->assertEquals($value, $foo->getValue());
    }

    public function testStructuredValueBasic()
    {
        $type = m::mock(IStructuredTypeReference::class)->makePartial();

        $prop1 = m::mock(IPropertyValue::class)->makePartial();
        $prop1->shouldReceive('getName')->andReturn('foo');
        $prop2 = m::mock(IPropertyValue::class)->makePartial();
        $prop2->shouldReceive('getName')->andReturn('bar');

        $foo = new EdmStructuredValue($type, [$prop1, $prop2]);

        $this->assertEquals(ValueKind::Structured(), $foo->getValueKind());
        $this->assertEquals([$prop1, $prop2], $foo->getPropertyValues());
        $this->assertEquals($foo, $foo->getValue());
    }

    public function testStructuredValueFindExistingPropertyValue()
    {
        $type = m::mock(IStructuredTypeReference::class)->makePartial();

        $prop1 = m::mock(IPropertyValue::class)->makePartial();
        $prop1->shouldReceive('getName')->andReturn('foo');
        $prop2 = m::mock(IPropertyValue::class)->makePartial();
        $prop2->shouldReceive('getName')->andReturn('bar');

        $foo = new EdmStructuredValue($type, [$prop1, $prop2]);

        $this->assertEquals($prop2, $foo->findPropertyValues('bar'));
    }

    public function testStructuredValueFindNonExistingPropertyValue()
    {
        $type = m::mock(IStructuredTypeReference::class)->makePartial();

        $prop1 = m::mock(IPropertyValue::class)->makePartial();
        $prop1->shouldReceive('getName')->andReturn('foo');
        $prop2 = m::mock(IPropertyValue::class)->makePartial();
        $prop2->shouldReceive('getName')->andReturn('bar');

        $foo = new EdmStructuredValue($type, [$prop1, $prop2]);

        $this->assertEquals(null, $foo->findPropertyValues('hammertime'));
    }

    public function testNullExpressionViaStatic()
    {
        $foo = EdmNullExpression::getInstance();

        $this->assertEquals(ExpressionKind::Null(), $foo->getExpressionKind());
        $this->assertEquals(ValueKind::Null(), $foo->getValueKind());
        $this->assertEquals(null, $foo->getValue());
    }

    public function testNullExpressionConstructGoesKaboom()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Illegal construction of AlgoWeb\ODataMetadata\Library\Values\EdmNullExpression');

        new EdmNullExpression();
    }
}
