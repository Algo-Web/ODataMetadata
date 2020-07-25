<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 27/06/20
 * Time: 7:12 AM.
 */
namespace AlgoWeb\ODataMetadata\Tests\Unit\Util;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;
use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Enums\PrimitiveTypeKind;
use AlgoWeb\ODataMetadata\Enums\TypeKind;
use AlgoWeb\ODataMetadata\Enums\ValueKind;
use AlgoWeb\ODataMetadata\Exception\ArgumentNullException;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IBinaryConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IBooleanConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IDateTimeConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IDateTimeOffsetConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IDecimalConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IFloatingConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IGuidConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IIntegerConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IStringConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\ITimeConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\IBinaryTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\ILocation;
use AlgoWeb\ODataMetadata\Interfaces\IStringTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IType;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
use AlgoWeb\ODataMetadata\Interfaces\Values\IPrimitiveValue;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use AlgoWeb\ODataMetadata\Util\ExpressionTypeChecker;
use Mockery as m;

class ExpressionTypeCheckerPrimitiveTest extends TestCase
{
    public function testTryAssertNullExpression()
    {
        $this->expectException(ArgumentNullException::class);
        $this->expectExceptionMessage('Value for parameter expression cannot be null.');

        ExpressionTypeChecker::tryAssertType();
    }

    public function testTryAssertTypeWithNullTypeRef()
    {
        $expression = m::mock(IExpression::class);

        $expected = true;
        $actual   = ExpressionTypeChecker::tryAssertType($expression);
        $this->assertEquals($expected, $actual);
    }

    public function testTryAssertTypeWithTypeRefIsNone()
    {
        $expression = m::mock(IExpression::class);

        $type = m::mock(ITypeReference::class);
        $type->shouldReceive('TypeKind->IsNone')->andReturn(true)->once();

        $errors = ['foo'];

        $expected = true;
        $actual   = ExpressionTypeChecker::tryAssertType($expression, $type, null, false, $errors);
        $this->assertEquals($expected, $actual);
        $this->assertEquals(0, count($errors));
    }

    public function primitiveTypeProvider(): array
    {
        $result = [];

        $result[] = [ExpressionKind::BinaryConstant(), ValueKind::Binary(), IBinaryConstantExpression::class, 'IsBinary', 'AsBinary', PrimitiveTypeKind::Binary(), []];
        $result[] = [ExpressionKind::BooleanConstant(), ValueKind::Boolean(), IBooleanConstantExpression::class, 'IsBoolean'];
        $result[] = [ExpressionKind::DateTimeConstant(), ValueKind::DateTime(), IDateTimeConstantExpression::class, 'IsDateTime'];
        $result[] = [ExpressionKind::DateTimeOffsetConstant(), ValueKind::DateTimeOffset(), IDateTimeOffsetConstantExpression::class, 'IsDateTimeOffset'];
        $result[] = [ExpressionKind::DecimalConstant(), ValueKind::Decimal(), IDecimalConstantExpression::class, 'IsDecimal'];
        $result[] = [ExpressionKind::FloatingConstant(), ValueKind::Floating(), IFloatingConstantExpression::class, 'IsFloating'];
        $result[] = [ExpressionKind::GuidConstant(), ValueKind::Guid(), IGuidConstantExpression::class, 'IsGuid'];
        $result[] = [ExpressionKind::IntegerConstant(), ValueKind::Integer(), IIntegerConstantExpression::class, 'IsIntegral', null, PrimitiveTypeKind::Int32(), 0];
        $result[] = [ExpressionKind::StringConstant(), ValueKind::String(), IStringConstantExpression::class, 'IsString', 'AsString', PrimitiveTypeKind::String(), ''];
        $result[] = [ExpressionKind::TimeConstant(), ValueKind::Time(), ITimeConstantExpression::class, 'IsTime'];

        return $result;
    }

    /**
     * @dataProvider primitiveTypeProvider
     *
     * @param ExpressionKind         $kind
     * @param ValueKind              $value
     * @param string                 $expressionType
     * @param string                 $checkMethod
     * @param string|null            $asMethod
     * @param PrimitiveTypeKind|null $primKind
     * @param mixed|null             $primVal
     */
    public function testTryAssertTypeWithPrimitiveTypeDirectlyAsserted(
        ExpressionKind $kind,
        ValueKind $value,
        string $expressionType,
        string $checkMethod,
        string $asMethod = null,
        PrimitiveTypeKind $primKind = null,
        $primVal = null
    ) {
        $expression = m::mock(IExpression::class . ', ' . IPrimitiveValue::class . ', ' . $expressionType);
        $expression->shouldReceive('getExpressionKind')->andReturn($kind);
        $expression->shouldReceive('getType')->andReturn(null);
        $expression->shouldReceive('getValueKind')->andReturn($value);

        $type = m::mock(ITypeReference::class);
        $type->shouldReceive('TypeKind')->andReturn(TypeKind::Primitive())->once();
        $type->shouldReceive('IsPrimitive')->andReturn(true);
        $type->shouldReceive($checkMethod)->andReturn(true);
        if (null !== $asMethod) {
            $result = null;
            switch ($asMethod) {
                case 'AsBinary':
                    $result = m::mock(IBinaryTypeReference::class);
                    $result->shouldReceive('getMaxLength')->andReturn(null);
                    break;
                case 'AsString':
                    $result = m::mock(IStringTypeReference::class);
                    $result->shouldReceive('getMaxLength')->andReturn(null);
                    break;
            }

            $type->shouldReceive($asMethod)->andReturn($result);
        }

        if (null !== $primKind) {
            $type->shouldReceive('PrimitiveKind')->andReturn($primKind);
            $expression->shouldReceive('getValue')->andReturn($primVal);
        }

        $errors = ['foo'];

        $expected = true;
        $actual   = ExpressionTypeChecker::tryAssertType($expression, $type, null, false, $errors);
        $this->assertEquals($expected, $actual);
        $this->assertEquals(0, count($errors));
    }

    /**
     * @dataProvider primitiveTypeProvider
     *
     * @param ExpressionKind $kind
     * @param ValueKind      $value
     * @param string         $expressionType
     * @param string         $checkMethod
     */
    public function testTryAssertTypeWithPrimitiveTypeDirectlyAssertedFailure(
        ExpressionKind $kind,
        ValueKind $value,
        string $expressionType,
        string $checkMethod
    ) {
        $expression = m::mock(IExpression::class . ', ' . IPrimitiveValue::class . ', ' . $expressionType);
        $expression->shouldReceive('getExpressionKind')->andReturn($kind);
        $expression->shouldReceive('getType')->andReturn(null);
        $expression->shouldReceive('getValueKind')->andReturn($value);
        $expression->shouldReceive('Location')->andReturn(null);

        $type = m::mock(ITypeReference::class);
        $type->shouldReceive('TypeKind')->andReturn(TypeKind::Primitive())->once();
        $type->shouldReceive('IsPrimitive')->andReturn(true);
        $type->shouldReceive($checkMethod)->andReturn(false);

        $errors = [];

        $expected = false;
        $actual   = ExpressionTypeChecker::tryAssertType($expression, $type, null, false, $errors);
        $this->assertEquals($expected, $actual);
        $this->assertEquals(1, count($errors));
    }

    public function testTryAssertPrimitiveTypeWithActualNonPrimitiveType()
    {
        $expression = m::mock(IExpression::class . ', ' . IPrimitiveValue::class);
        $expression->shouldReceive('Location')->andReturn(null);
        $type = m::mock(ITypeReference::class);
        $type->shouldReceive('IsPrimitive')->andReturn(false)->once();

        $expected = false;
        $errors   = [];

        $expected = false;
        $actual   = ExpressionTypeChecker::tryAssertPrimitiveAsType($expression, $type, $errors);
        $this->assertEquals($expected, $actual);
        $this->assertEquals(1, count($errors));
        /** @var EdmError $error */
        $error = $errors[0];

        $expected = 'A primitive expression is incompatible with a non-primitive type.';
        $actual   = $error->getErrorMessage();
        $this->assertEquals($expected, $actual);
        $this->assertNull($error->getErrorLocation());
    }

    public function testTryAssertPrimitiveTypeWithActualPrimitiveBadType()
    {
        $expression = m::mock(IExpression::class . ', ' . IPrimitiveValue::class);
        $expression->shouldReceive('Location')->andReturn(null);
        $expression->shouldReceive('getValueKind')->andReturn(m::mock(ValueKind::class));
        $type = m::mock(ITypeReference::class);
        $type->shouldReceive('IsPrimitive')->andReturn(true)->once();

        $expected = false;
        $errors   = [];

        $expected = false;
        $actual   = ExpressionTypeChecker::tryAssertPrimitiveAsType($expression, $type, $errors);
        $this->assertEquals($expected, $actual);
        $this->assertEquals(1, count($errors));
        /** @var EdmError $error */
        $error = $errors[0];

        $expected = 'The primitive expression is not compatible with the asserted type.';
        $actual   = $error->getErrorMessage();
        $this->assertEquals($expected, $actual);
        $this->assertNull($error->getErrorLocation());
    }

    public function stringConstantProvider(): array
    {
        $result = [];

        $result[] = ['a', true];
        $result[] = ['ab', true];
        $result[] = ['abc', false];

        return $result;
    }

    /**
     * @dataProvider stringConstantProvider
     *
     * @param string $value
     * @param bool   $expected
     */
    public function testTryAssertTypeStringTypeWithDifferentLengths(string $value, bool $expected)
    {
        $expressionType = IStringConstantExpression::class;
        $kind           = ExpressionKind::StringConstant();
        $valueKind      = ValueKind::String();

        $result = m::mock(IStringTypeReference::class);
        $result->shouldReceive('getMaxLength')->andReturn(2);

        $expression = m::mock(IExpression::class . ', ' . IPrimitiveValue::class . ', ' . $expressionType);
        $expression->shouldReceive('getExpressionKind')->andReturn($kind);
        $expression->shouldReceive('getType')->andReturn(null);
        $expression->shouldReceive('getValueKind')->andReturn($valueKind);
        $expression->shouldReceive('getValue')->andReturn($value);
        $expression->shouldReceive('Location')->andReturn(null);

        $type = m::mock(ITypeReference::class);
        $type->shouldReceive('TypeKind')->andReturn(TypeKind::Primitive())->once();
        $type->shouldReceive('IsPrimitive')->andReturn(true);
        $type->shouldReceive('IsString')->andReturn(true);
        $type->shouldReceive('AsString')->andReturn($result);

        $errors = [];

        $actual = ExpressionTypeChecker::tryAssertType($expression, $type, null, false, $errors);
        $this->assertEquals($expected, $actual);
        $this->assertEquals(intval(!$expected), count($errors));
    }

    public function binaryConstantProvider(): array
    {
        $result = [];

        $result[] = [['a'], true];
        $result[] = [['a', 'b'], true];
        $result[] = [['a', 'b', 'c'], false];

        return $result;
    }

    /**
     * @dataProvider binaryConstantProvider
     *
     * @param array $value
     * @param bool  $expected
     */
    public function testTryAssertTypeBinaryTypeWithDifferentLengths(array $value, bool $expected)
    {
        $expressionType = IBinaryConstantExpression::class;
        $kind           = ExpressionKind::BinaryConstant();
        $valueKind      = ValueKind::Binary();

        $result = m::mock(IBinaryTypeReference::class);
        $result->shouldReceive('getMaxLength')->andReturn(2);

        $expression = m::mock(IExpression::class . ', ' . IPrimitiveValue::class . ', ' . $expressionType);
        $expression->shouldReceive('getExpressionKind')->andReturn($kind);
        $expression->shouldReceive('getType')->andReturn(null);
        $expression->shouldReceive('getValueKind')->andReturn($valueKind);
        $expression->shouldReceive('getValue')->andReturn($value);
        $expression->shouldReceive('Location')->andReturn(null);

        $type = m::mock(ITypeReference::class);
        $type->shouldReceive('TypeKind')->andReturn(TypeKind::Primitive())->once();
        $type->shouldReceive('IsPrimitive')->andReturn(true);
        $type->shouldReceive('IsBinary')->andReturn(true);
        $type->shouldReceive('AsBinary')->andReturn($result);

        $errors = [];

        $actual = ExpressionTypeChecker::tryAssertType($expression, $type, null, false, $errors);
        $this->assertEquals($expected, $actual);
        $this->assertEquals(intval(!$expected), count($errors));
    }

    public function integerConstantRangeProvider(): array
    {
        $result   = [];
        $result[] = [PrimitiveTypeKind::Int64(), -9223372036854775808, true];
        $result[] = [PrimitiveTypeKind::Int64(), -9223372036854775808 + 1, true];
        $result[] = [PrimitiveTypeKind::Int64(), 9223372036854775807 - 1, true];
        $result[] = [PrimitiveTypeKind::Int64(), 9223372036854775807, true];
        $result[] = [PrimitiveTypeKind::Int32(), -2147483648 - 1, false];
        $result[] = [PrimitiveTypeKind::Int32(), -2147483648, true];
        $result[] = [PrimitiveTypeKind::Int32(), -2147483648 + 1, true];
        $result[] = [PrimitiveTypeKind::Int32(), 2147483647 - 1, true];
        $result[] = [PrimitiveTypeKind::Int32(), 2147483647, true];
        $result[] = [PrimitiveTypeKind::Int32(), 2147483647 + 1, false];
        $result[] = [PrimitiveTypeKind::Int16(), -32768 - 1, false];
        $result[] = [PrimitiveTypeKind::Int16(), -32768, true];
        $result[] = [PrimitiveTypeKind::Int16(), -32768 + 1, true];
        $result[] = [PrimitiveTypeKind::Int16(), 32767 - 1, true];
        $result[] = [PrimitiveTypeKind::Int16(), 32767, true];
        $result[] = [PrimitiveTypeKind::Int16(), 32767 + 1, false];
        $result[] = [PrimitiveTypeKind::Byte(), 0 - 1, false];
        $result[] = [PrimitiveTypeKind::Byte(), 0, true];
        $result[] = [PrimitiveTypeKind::Byte(), 0 + 1, true];
        $result[] = [PrimitiveTypeKind::Byte(), 255 - 1, true];
        $result[] = [PrimitiveTypeKind::Byte(), 255, true];
        $result[] = [PrimitiveTypeKind::Byte(), 255 + 1, false];
        $result[] = [PrimitiveTypeKind::SByte(), -128 - 1, false];
        $result[] = [PrimitiveTypeKind::SByte(), -128, true];
        $result[] = [PrimitiveTypeKind::SByte(), -128 + 1, true];
        $result[] = [PrimitiveTypeKind::SByte(), 127 - 1, true];
        $result[] = [PrimitiveTypeKind::SByte(), 127, true];
        $result[] = [PrimitiveTypeKind::SByte(), 127 + 1, false];
        $result[] = [PrimitiveTypeKind::String(), 0, false];

        return $result;
    }

    /**
     * @dataProvider integerConstantRangeProvider
     *
     * @param PrimitiveTypeKind $primKind
     * @param $value
     * @param bool $expected
     */
    public function testTryAssertTypeIntegerBoundaryRangeChecks(PrimitiveTypeKind $primKind, $value, bool $expected)
    {
        $expressionType = IIntegerConstantExpression::class;
        $kind           = ExpressionKind::IntegerConstant();
        $valueKind      = ValueKind::Integer();

        $expression = m::mock(IExpression::class . ', ' . IPrimitiveValue::class . ', ' . $expressionType);
        $expression->shouldReceive('getExpressionKind')->andReturn($kind);
        $expression->shouldReceive('getType')->andReturn(null);
        $expression->shouldReceive('getValueKind')->andReturn($valueKind);
        $expression->shouldReceive('getValue')->andReturn($value);
        $expression->shouldReceive('Location')->andReturn(null);

        $type = m::mock(ITypeReference::class);
        $type->shouldReceive('TypeKind')->andReturn(TypeKind::Primitive())->once();
        $type->shouldReceive('IsPrimitive')->andReturn(true);
        $type->shouldReceive('IsIntegral')->andReturn(true);
        $type->shouldReceive('PrimitiveKind')->andReturn($primKind);

        $errors = [];

        $actual = ExpressionTypeChecker::tryAssertType($expression, $type, null, false, $errors);
        $this->assertEquals($expected, $actual);
        $this->assertEquals(intval(!$expected), count($errors));
    }

    public function testTryAssertTypeNullablePrimitiveTypeCollision()
    {
        $loc = m::mock(ILocation::class);

        $checkType = m::mock(ITypeReference::class);
        $checkType->shouldReceive('getNullable')->andReturn(true);
        $checkType->shouldReceive('FullName')->andReturn('CheckType');

        $expression = m::mock(IExpression::class . ', ' . IPrimitiveValue::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::StringConstant());
        $expression->shouldReceive('getType')->andReturn($checkType)->atLeast(1);
        $expression->shouldReceive('Location')->andReturn($loc);

        $type = m::mock(ITypeReference::class);
        $type->shouldReceive('TypeKind')->andReturn(TypeKind::Primitive())->once();
        $type->shouldReceive('getNullable')->andReturn(false);
        $type->shouldReceive('FullName')->andReturn('MainType');

        $errors = [];

        $expected = false;
        $actual   = ExpressionTypeChecker::tryAssertType($expression, $type, null, false, $errors);
        $this->assertEquals($expected, $actual);
        $this->assertEquals(intval(!$expected), count($errors));

        /** @var EdmError $error */
        $error = $errors[0];

        $expected = 'Cannot assert the nullable type \'CheckType\' as a non-nullable type.';
        $actual   = $error->getErrorMessage();
        $this->assertEquals($expected, $actual);
    }

    public function testTryAssertTypeBadPrimitiveTypePasses()
    {
        $loc = m::mock(ILocation::class);

        $error = m::mock(EdmError::class);

        $checkType = m::mock(ITypeReference::class);
        $checkType->shouldReceive('getNullable')->andReturn(false);
        $checkType->shouldReceive('FullName')->andReturn('CheckType');
        $checkType->shouldReceive('getErrors')->andReturn([$error])->once();

        $expression = m::mock(IExpression::class . ', ' . IPrimitiveValue::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::StringConstant());
        $expression->shouldReceive('getType')->andReturn($checkType)->atLeast(1);
        $expression->shouldReceive('Location')->andReturn($loc);

        $type = m::mock(ITypeReference::class);
        $type->shouldReceive('TypeKind')->andReturn(TypeKind::Primitive())->once();
        $type->shouldReceive('getNullable')->andReturn(false);
        $type->shouldReceive('FullName')->andReturn('MainType');
        $type->shouldReceive('getErrors')->andReturn([$error])->once();

        $errors = [];

        $expected = true;
        $actual   = ExpressionTypeChecker::tryAssertType($expression, $type, null, false, $errors);
        $this->assertEquals($expected, $actual);
        $this->assertEquals(intval(!$expected), count($errors));
    }
}
