<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 1/07/20
 * Time: 9:23 PM.
 */
namespace AlgoWeb\ODataMetadata\Tests\Unit\Helpers;

use AlgoWeb\ODataMetadata\Enums\FunctionParameterMode;
use AlgoWeb\ODataMetadata\Enums\PrimitiveTypeKind;
use AlgoWeb\ODataMetadata\Enums\TypeKind;
use AlgoWeb\ODataMetadata\Helpers\EdmElementComparer;
use AlgoWeb\ODataMetadata\Interfaces\IBinaryTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IDecimalTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionBase;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionParameter;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveType;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IProperty;
use AlgoWeb\ODataMetadata\Interfaces\IRowType;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaType;
use AlgoWeb\ODataMetadata\Interfaces\ISpatialTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IStringTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IStructuralProperty;
use AlgoWeb\ODataMetadata\Interfaces\ITemporalTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IType;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class EdmElementComparerTest extends TestCase
{
    public function testNotEquivalentWhenBothNull()
    {
        $expected = false;
        $actual   = EdmElementComparer::isEquivalentTo(null, null);
        $this->assertEquals($expected, $actual);
    }

    public function testNotEquivalentWhenFirstNull()
    {
        $element = m::mock(IEdmElement::class);

        $expected = false;
        $actual   = EdmElementComparer::isEquivalentTo(null, $element);
        $this->assertEquals($expected, $actual);
    }

    public function testNotEquivalentWhenSecondNull()
    {
        $element = m::mock(IEdmElement::class);

        $expected = false;
        $actual   = EdmElementComparer::isEquivalentTo($element, null);
        $this->assertEquals($expected, $actual);
    }

    public function identityProvider(): array
    {
        $result   = [];
        $result[] = [IType::class];
        $result[] = [ITypeReference::class];
        $result[] = [IFunctionParameter::class];
        $result[] = [ISchemaType::class];
        $result[] = [IStructuralProperty::class];

        return $result;
    }

    /**
     * @dataProvider identityProvider
     *
     * @param string $class
     */
    public function testIsEquivalentUnderIdentity(string $class)
    {
        $element = m::mock(IEdmElement::class . ', ' . $class)->makePartial();

        $expected = true;
        $actual   = EdmElementComparer::isEquivalentTo($element, $element);
        $this->assertEquals($expected, $actual);
    }

    /**
     * @dataProvider identityProvider
     *
     * @param string $class
     */
    public function testIsEquivalentUnderEquivalence2(string $class)
    {
        $rawDef = m::mock(IType::class);
        $def    = m::mock(ITypeReference::class);

        $element = m::mock(IEdmElement::class . ', ' . $class)->makePartial();
        $element->shouldReceive('getName')->andReturn('Name');
        $element->shouldReceive('getTypeKind')->andReturn(TypeKind::Entity());
        $element->shouldReceive('TypeKind')->andReturn(TypeKind::Entity());
        $element->shouldReceive('getMode')->andReturn(FunctionParameterMode::InOut());
        $element->shouldReceive('getType')->andReturn($def);
        $element->shouldReceive('getNullable')->andReturn(false);
        $element->shouldReceive('getDefinition')->andReturn($rawDef);

        $newElement = clone $element;

        // if we have two equivalent-but-not-identical schema types, whole schema is out to lunch
        $expected = (ISchemaType::class !== $class);
        $actual   = EdmElementComparer::isEquivalentTo($element, $newElement);
        $this->assertEquals($expected, $actual);
    }

    public function identityPrimitiveProvider(): array
    {
        $result   = [];
        $result[] = [IPrimitiveType::class, PrimitiveTypeKind::Int32()];
        $result[] = [IPrimitiveTypeReference::class, PrimitiveTypeKind::Int32()];
        $result[] = [IBinaryTypeReference::class, PrimitiveTypeKind::Binary()];
        $result[] = [IDecimalTypeReference::class, PrimitiveTypeKind::Decimal()];
        $result[] = [ITemporalTypeReference::class, PrimitiveTypeKind::Time()];
        $result[] = [IStringTypeReference::class, PrimitiveTypeKind::String()];
        $result[] = [ISpatialTypeReference::class, PrimitiveTypeKind::GeometryMultiPoint()];

        return $result;
    }

    /**
     * @dataProvider identityPrimitiveProvider
     *
     * @param string            $class
     * @param PrimitiveTypeKind $primKind
     */
    public function testIsEquivalentUnderIdentityPrimitive(string $class, PrimitiveTypeKind $primKind)
    {
        $def = m::mock(IType::class);

        $element = m::mock(IEdmElement::class . ', ' . $class)->makePartial();
        $element->shouldReceive('getNullable')->andReturn(false);
        $element->shouldReceive('getIsFixedLength')->andReturn(true);
        $element->shouldReceive('isFixedLength')->andReturn(true);
        $element->shouldReceive('getIsUnbounded')->andReturn(false);
        $element->shouldReceive('isUnbounded')->andReturn(false);
        $element->shouldReceive('getIsUnicode')->andReturn(false);
        $element->shouldReceive('isUnicode')->andReturn(false);
        $element->shouldReceive('getPrecision')->andReturn(6);
        $element->shouldReceive('getScale')->andReturn(2);
        $element->shouldReceive('getMaxLength')->andReturn(10);
        $element->shouldReceive('PrimitiveKind')->andReturn($primKind);
        $element->shouldReceive('getPrimitiveKind')->andReturn($primKind);
        $element->shouldReceive('TypeKind')->andReturn(TypeKind::Primitive());
        $element->shouldReceive('getDefinition')->andReturn($def);
        $element->shouldReceive('getCollation')->andReturn(null);
        $element->shouldReceive('getSpatialReferenceIdentifier')->andReturn(null);
        $element->shouldReceive('FullName')->andReturn('FullName');

        $expected = true;
        $actual   = EdmElementComparer::isEquivalentTo($element, $element);
        $this->assertEquals($expected, $actual);
    }

    /**
     * @dataProvider identityPrimitiveProvider
     *
     * @param string            $class
     * @param PrimitiveTypeKind $primKind
     */
    public function testIsEquivalentUnderEquivalencePrimitive(string $class, PrimitiveTypeKind $primKind)
    {
        $def = m::mock(IType::class);

        $element = m::mock(IEdmElement::class . ', ' . $class)->makePartial();
        $element->shouldReceive('getNullable')->andReturn(false);
        $element->shouldReceive('getIsFixedLength')->andReturn(true);
        $element->shouldReceive('isFixedLength')->andReturn(true);
        $element->shouldReceive('getIsUnbounded')->andReturn(false);
        $element->shouldReceive('isUnbounded')->andReturn(false);
        $element->shouldReceive('getIsUnicode')->andReturn(false);
        $element->shouldReceive('isUnicode')->andReturn(false);
        $element->shouldReceive('getPrecision')->andReturn(6);
        $element->shouldReceive('getScale')->andReturn(2);
        $element->shouldReceive('getMaxLength')->andReturn(10);
        $element->shouldReceive('PrimitiveKind')->andReturn($primKind);
        $element->shouldReceive('getPrimitiveKind')->andReturn($primKind);
        $element->shouldReceive('getTypeKind')->andReturn(TypeKind::Primitive());
        $element->shouldReceive('TypeKind')->andReturn(TypeKind::Primitive());
        $element->shouldReceive('getDefinition')->andReturn($def);
        $element->shouldReceive('getCollation')->andReturn(null);
        $element->shouldReceive('getSpatialReferenceIdentifier')->andReturn(null);
        $element->shouldReceive('FullName')->andReturn('FullName');

        $newElement = clone $element;
        // if we have two equivalent-but-not-identical schema types, whole schema is out to lunch
        $expected = (IPrimitiveType::class !== $class);
        $actual   = EdmElementComparer::isEquivalentTo($element, $newElement);
        $this->assertEquals($expected, $actual);
    }

    public function testIsEquivalentToRowTypeUnderIdentityNoProperties()
    {
        $class   = IRowType::class;
        $element = m::mock(IEdmElement::class . ', ' . $class)->makePartial();
        $element->shouldReceive('getDeclaredProperties')->andReturn([]);

        $expected = true;
        $actual   = EdmElementComparer::isEquivalentTo($element, $element);
        $this->assertEquals($expected, $actual);
    }

    public function testIsEquivalentToRowTypeUnderIdentityTwoProperties()
    {
        $prop1 = m::mock(IProperty::class)->makePartial();
        $prop2 = m::mock(IProperty::class)->makePartial();

        $class   = IRowType::class;
        $element = m::mock(IEdmElement::class . ', ' . $class)->makePartial();
        $element->shouldReceive('getDeclaredProperties')->andReturn([$prop1, $prop2]);

        $expected = true;
        $actual   = EdmElementComparer::isEquivalentTo($element, $element);
        $this->assertEquals($expected, $actual);
    }

    public function testIsFunctionSignatureEquivalentUnderIdentity()
    {
        $class   = IFunctionBase::class;
        $element = m::mock(IEdmElement::class . ', ' . $class)->makePartial();

        $expected = true;
        $actual   = EdmElementComparer::isFunctionSignatureEquivalentTo($element, $element);
        $this->assertEquals($expected, $actual);
    }

    public function testIsFunctionSignatureEquivalentUnderEquivalence()
    {
        $def = m::mock(ITypeReference::class);

        $funcParm = m::mock(IFunctionParameter::class)->makePartial();

        $class   = IFunctionBase::class;
        $element = m::mock(IEdmElement::class . ', ' . $class)->makePartial();
        $element->shouldReceive('getName')->andReturn('Name');
        $element->shouldReceive('getReturnType')->andReturn($def);
        $element->shouldReceive('getParameters')->andReturn([$funcParm]);

        $newElement = clone $element;

        $expected = true;
        $actual   = EdmElementComparer::isFunctionSignatureEquivalentTo($element, $newElement);
        $this->assertEquals($expected, $actual);
    }

    public function testIsFunctionSignatureNotEquivalentWhenBothNull()
    {
        $expected = false;
        $actual   = EdmElementComparer::isFunctionSignatureEquivalentTo(null, null);
        $this->assertEquals($expected, $actual);
    }

    public function testIsFunctionSignatureNotEquivalentWhenFirstNull()
    {
        $class   = IFunctionBase::class;
        $element = m::mock(IEdmElement::class . ', ' . $class)->makePartial();

        $expected = false;
        $actual   = EdmElementComparer::isFunctionSignatureEquivalentTo(null, $element);
        $this->assertEquals($expected, $actual);
    }

    public function testIsFunctionSignatureNotEquivalentWhenSecondNull()
    {
        $class   = IFunctionBase::class;
        $element = m::mock(IEdmElement::class . ', ' . $class)->makePartial();

        $expected = false;
        $actual   = EdmElementComparer::isFunctionSignatureEquivalentTo($element, null);
        $this->assertEquals($expected, $actual);
    }
}
