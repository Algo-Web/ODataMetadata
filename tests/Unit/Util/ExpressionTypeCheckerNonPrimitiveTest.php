<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 27/06/20
 * Time: 8:43 PM.
 */
namespace AlgoWeb\ODataMetadata\Tests\Unit\Util;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;
use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Enums\PrimitiveTypeKind;
use AlgoWeb\ODataMetadata\Enums\TypeKind;
use AlgoWeb\ODataMetadata\Enums\ValueKind;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IApplyExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IIfExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IIntegerConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IIsTypeExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\INullExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IPathExpression;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionBase;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Interfaces\IProperty;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredType;
use AlgoWeb\ODataMetadata\Interfaces\IType;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
use AlgoWeb\ODataMetadata\Interfaces\Values\IPrimitiveValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\IPropertyValue;
use AlgoWeb\ODataMetadata\Library\EdmElement;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use AlgoWeb\ODataMetadata\Util\ExpressionTypeChecker;
use Mockery as m;
use PhpParser\Node\Stmt\Expression;

class ExpressionTypeCheckerNonPrimitiveTest extends TestCase
{
    public function testTryAssertTypeNullExpressionIsNullable()
    {
        $expression = m::mock(INullExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::Null());

        $type = m::mock(ITypeReference::class);
        $type->shouldReceive('TypeKind->IsNone')->andReturn(false)->once();
        $type->shouldReceive('getNullable')->andReturn(true);

        $errors = ['foo'];

        $expected = true;
        $actual   = ExpressionTypeChecker::tryAssertType($expression, $type, null, false, $errors);
        $this->assertEquals($expected, $actual);
        $this->assertEquals(0, count($errors));
    }

    public function testTryAssertTypeNullExpressionIsNotNullable()
    {
        $expression = m::mock(INullExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::Null());
        $expression->shouldReceive('Location')->andReturn(null);

        $type = m::mock(ITypeReference::class);
        $type->shouldReceive('TypeKind->IsNone')->andReturn(false)->once();
        $type->shouldReceive('getNullable')->andReturn(false);

        $errors = [];

        $expected = false;
        $actual   = ExpressionTypeChecker::tryAssertType($expression, $type, null, false, $errors);
        $this->assertEquals($expected, $actual);
        $this->assertEquals(1, count($errors));

        /** @var EdmError $error */
        $error = $errors[0];

        $expected = 'Null value cannot have a non-nullable type.';
        $actual   = $error->getErrorMessage();
        $this->assertEquals($expected, $actual);
    }

    public function testTryAssertTypePathOfBadType()
    {
        $expression = m::mock(IPathExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::Path());
        $expression->shouldReceive('Location')->andReturn(null);
        $expression->shouldReceive('getPath')->andReturn(['foo']);

        $type = m::mock(ITypeReference::class);
        $type->shouldReceive('TypeKind->IsNone')->andReturn(false)->once();
        $type->shouldReceive('getNullable')->andReturn(false);

        $context = m::mock(IStructuredType::class);
        $context->shouldReceive('findProperty')->andReturn(null)->once();

        $errors   = [];
        $expected = false;
        $actual   = ExpressionTypeChecker::tryAssertType($expression, $type, $context, false, $errors);
        $this->assertEquals($expected, $actual);
        $this->assertEquals(1, count($errors));

        /** @var EdmError $error */
        $error = $errors[0];

        $expected = 'The path cannot be resolved in the given context. The segment \'foo\' failed to resolve.';
        $actual   = $error->getErrorMessage();
        $this->assertEquals($expected, $actual);
    }

    public function testTryAssertTypePathOfNullType()
    {
        $expression = m::mock(IPathExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::Path());
        $expression->shouldReceive('Location')->andReturn(null);
        $expression->shouldReceive('getPath')->andReturn(['foo']);

        $type = m::mock(ITypeReference::class);
        $type->shouldReceive('TypeKind->IsNone')->andReturn(false)->once();
        $type->shouldReceive('getNullable')->andReturn(false);

        $context = m::mock(IStructuredType::class);
        $context->shouldReceive('findProperty')->andReturn(null)->once();

        $errors   = [];
        $expected = true;
        $actual   = ExpressionTypeChecker::tryAssertType($expression, $type, $context, false, $errors);
        $this->assertEquals($expected, $actual);
        $this->assertEquals(0, count($errors));
    }

    public function testTryAssertTypePathOfNonNullButUndefinedType()
    {
        $expression = m::mock(IPathExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::Path());
        $expression->shouldReceive('Location')->andReturn(null);
        $expression->shouldReceive('getPath')->andReturn(['foo']);

        $type = m::mock(ITypeReference::class);
        $type->shouldReceive('TypeKind->IsNone')->andReturn(false)->once();
        $type->shouldReceive('getNullable')->andReturn(false);

        $prop = m::mock(IProperty::class);
        $prop->shouldReceive('getType->getDefinition')->andReturn(null)->once();

        $context = m::mock(IStructuredType::class);
        $context->shouldReceive('findProperty')->andReturn($prop)->once();

        $errors   = [];
        $expected = true;
        $actual   = ExpressionTypeChecker::tryAssertType($expression, $type, $context, false, $errors);
        $this->assertEquals($expected, $actual);
        $this->assertEquals(0, count($errors));
    }

    public function testTryAssertTypePathOfNonNullDefinedType()
    {
        $expression = m::mock(IPathExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::Path());
        $expression->shouldReceive('Location')->andReturn(null);
        $expression->shouldReceive('getPath')->andReturn(['foo']);

        $defType = m::mock(IType::class);

        $type = m::mock(ITypeReference::class);
        $type->shouldReceive('TypeKind->IsNone')->andReturn(false)->once();
        $type->shouldReceive('getNullable')->andReturn(false);
        $type->shouldReceive('getDefinition')->andReturn($defType);

        $rType = m::mock(IType::class);
        $rType->shouldReceive('getTypeKind->isNone')->andReturn(true)->once();

        $prop = m::mock(IProperty::class);
        $prop->shouldReceive('getType->getDefinition')->andReturn($rType)->once();

        $context = m::mock(IStructuredType::class);
        $context->shouldReceive('findProperty')->andReturn($prop)->once();

        $errors   = [];
        $expected = true;
        $actual   = ExpressionTypeChecker::tryAssertType($expression, $type, $context, false, $errors);
        $this->assertEquals($expected, $actual);
        $this->assertEquals(0, count($errors));
    }

    public function testTryAssertTypeFunctionExpressionWithNullFunction()
    {
        $expression = m::mock(IApplyExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::FunctionApplication());
        $expression->shouldReceive('Location')->andReturn(null);
        $expression->shouldReceive('getAppliedFunction')->andReturn(null)->once();

        $type = m::mock(ITypeReference::class);
        $type->shouldReceive('TypeKind->IsNone')->andReturn(false)->once();
        $type->shouldReceive('getNullable')->andReturn(false);

        $context = null;

        $errors   = [];
        $expected = true;
        $actual   = ExpressionTypeChecker::tryAssertType($expression, $type, $context, false, $errors);
        $this->assertEquals($expected, $actual);
        $this->assertEquals(0, count($errors));
    }

    public function testTryAssertTypeFunctionExpressionWithNonNullFunction()
    {
        $func = m::mock(IExpression::class);
        $func->shouldReceive('getAppliedFunction')->andReturn(null)->once();

        $expression = m::mock(IApplyExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::FunctionApplication());
        $expression->shouldReceive('Location')->andReturn(null);
        $expression->shouldReceive('getAppliedFunction')->andReturn($func)->once();

        $type = m::mock(ITypeReference::class);
        $type->shouldReceive('TypeKind->IsNone')->andReturn(false)->once();
        $type->shouldReceive('getNullable')->andReturn(false);

        $context = null;

        $errors   = [];
        $expected = true;
        $actual   = ExpressionTypeChecker::tryAssertType($expression, $type, $context, false, $errors);
        $this->assertEquals($expected, $actual);
        $this->assertEquals(0, count($errors));
    }

    public function functionExpressionMatchExactlyProvider(): array
    {
        $result   = [];
        $result[] = [true, true, null];
        $result[] = [false, false, 'The type of the expression is incompatible with the asserted type.'];

        return $result;
    }

    /**
     * @dataProvider functionExpressionMatchExactlyProvider
     *
     * @param bool        $expected
     * @param bool        $isEquivalent
     * @param string|null $msg
     */
    public function testTryAssertTypeFunctionExpressionMatchExactly(bool $expected, bool $isEquivalent, ?string $msg)
    {
        $typeDef = m::mock(IEdmElement::class . ', ' . IType::class);
        $typeDef->shouldReceive('getTypeKind')->andReturn(TypeKind::Primitive());
        if ($isEquivalent) {
            $returnDef = m::mock(IEdmElement::class . ', ' . IType::class);
            $returnDef->shouldReceive('getTypeKind')->andReturn(TypeKind::Primitive());
        } else {
            $returnDef = m::mock(IEdmElement::class . ', ' . IType::class);
            $returnDef->shouldReceive('getTypeKind')->andReturn(TypeKind::None());
        }

        $returnType = m::mock(ITypeReference::class);
        $returnType->shouldReceive('getNullable')->andReturn(false);
        $returnType->shouldReceive('getErrors')->andReturn([]);
        $returnType->shouldReceive('getDefinition')->andReturn($returnDef);

        $base = m::mock(IFunctionBase::class)->makePartial();
        $base->shouldReceive('getReturnType')->andReturn($returnType);

        $func = m::mock(IExpression::class . ', ' . IFunctionBase::class);
        $func->shouldReceive('getAppliedFunction')->andReturn($base)->once();
        $func->shouldReceive('getReturnType')->andReturn($returnType);

        $expression = m::mock(IApplyExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::FunctionApplication());
        $expression->shouldReceive('Location')->andReturn(null);
        $expression->shouldReceive('getAppliedFunction')->andReturn($func)->once();

        $type = m::mock(ITypeReference::class);
        $type->shouldReceive('TypeKind->IsNone')->andReturn(false)->once();
        $type->shouldReceive('getNullable')->andReturn(false);
        $type->shouldReceive('getErrors')->andReturn([]);
        $type->shouldReceive('getDefinition')->andReturn($typeDef);

        $context = null;

        $errors = [];
        $actual = ExpressionTypeChecker::tryAssertType($expression, $type, $context, true, $errors);

        $this->assertEquals($expected, $actual);
        $this->assertEquals(intval(!$expected), count($errors));
        if (null !== $msg) {
            /** @var EdmError $error */
            $error = $errors[0];
            $this->assertEquals($msg, $error->getErrorMessage());
        }
    }

    public function typeMatchProvider(): array
    {
        //expressedPrimitive assertedPrimitive samePrimitiveTypeKind promotesTo inheritsFrom  expected msg
        $result   = [];
        $result[] = [true, true, false, false, true, false, 'Cannot promote the primitive type \'UnknownType\' to the specified primitive type \'UnknownType\'.'];
        $result[] = [false, false, false, false, false, false, 'The type of the expression is incompatible with the asserted type.'];
        $result[] = [false, true, false, true, false, false, 'The type of the expression is incompatible with the asserted type.'];
        $result[] = [false, false, true, true, true, true, null];
        $result[] = [false, true, true, false, false, false, 'The type of the expression is incompatible with the asserted type.'];
        $result[] = [false, false, true, false, true, true, null];
        $result[] = [true, true, true, true, false, false, 'Cannot promote the primitive type \'UnknownType\' to the specified primitive type \'UnknownType\'.'];
        $result[] = [true, false, false, true, false, false, 'The type of the expression is incompatible with the asserted type.'];
        $result[] = [true, true, true, true, true, false, 'Cannot promote the primitive type \'UnknownType\' to the specified primitive type \'UnknownType\'.'];
        $result[] = [true, false, true, false, true, true, null];
        $result[] = [false, false, false, true, true, true, null];
        $result[] = [true, false, true, false, false, false, 'The type of the expression is incompatible with the asserted type.'];
        $result[] = [false, true, false, true, true, true, null];

        return $result;
    }

    /**
     * @dataProvider typeMatchProvider
     *
     * @param bool        $expressedPrimitive
     * @param bool        $assertedPrimitive
     * @param bool        $samePrimitiveType
     * @param bool        $promotesTo
     * @param bool        $inheritsFrom
     * @param bool|null   $expected
     * @param string|null $msg
     */
    public function testTryAssertTypeFunctionExpressionMatchNotExactly(
        bool $expressedPrimitive,
        bool $assertedPrimitive,
        bool $samePrimitiveType,
        bool $promotesTo,
        bool $inheritsFrom,
        bool $expected,
        ?string $msg
    ) {
        $primType1 = PrimitiveTypeKind::Int16();
        if ($samePrimitiveType) {
            $primType2 = PrimitiveTypeKind::Int16();
        } else {
            if ($promotesTo) {
                $primType2 = PrimitiveTypeKind::Int32();
            } else {
                $primType2 = PrimitiveTypeKind::String();
            }
        }

        $typeDef = m::mock(IEdmElement::class . ', ' . IType::class);
        $typeDef->shouldReceive('getTypeKind')
            ->andReturn($expressedPrimitive ? TypeKind::Primitive() : TypeKind::Entity());
        $typeDef->shouldReceive('getPrimitiveKind')->andReturn($primType1);
        $typeDef->shouldReceive('getErrors')->andReturn([])->atLeast(1);

        $returnDef = m::mock(IEdmElement::class . ', ' . IType::class);
        $returnDef->shouldReceive('getTypeKind')
            ->andReturn($assertedPrimitive ? TypeKind::Primitive() : TypeKind::Entity());
        $returnDef->shouldReceive('getPrimitiveKind')->andReturn($primType2);
        $returnDef->shouldReceive('getErrors')->andReturn([])->atLeast(1);
        $returnDef->shouldReceive('IsOrInheritsFrom')->andReturn($inheritsFrom);

        $returnType = m::mock(ITypeReference::class);
        $returnType->shouldReceive('getNullable')->andReturn(false);
        $returnType->shouldReceive('getErrors')->andReturn([]);
        $returnType->shouldReceive('getDefinition')->andReturn($returnDef);

        $base = m::mock(IFunctionBase::class)->makePartial();

        $func = m::mock(IExpression::class . ', ' . IFunctionBase::class);
        $func->shouldReceive('getAppliedFunction')->andReturn($base)->once();
        $func->shouldReceive('getReturnType')->andReturn($returnType);

        $expression = m::mock(IApplyExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::FunctionApplication());
        $expression->shouldReceive('getAppliedFunction')->andReturn($func);
        $expression->shouldReceive('Location')->andReturn(null);

        $typeKind = TypeKind::Primitive();
        $type     = m::mock(ITypeReference::class);
        $type->shouldReceive('TypeKind')->andReturn($typeKind);
        $type->shouldReceive('getNullable')->andReturn(false);
        $type->shouldReceive('getDefinition')->andReturn($typeDef);

        $context = null;

        $errors = [];
        $actual = ExpressionTypeChecker::tryAssertType($expression, $type, $context, false, $errors);

        $this->assertEquals($expected, $actual);
        $this->assertEquals(intval(!$expected), count($errors));
        if (!$expected) {
            /** @var EdmError $error */
            $error = $errors[0];
            $this->assertEquals($msg, $error->getErrorMessage());
        }
    }

    public function ifTypeProvider(): array
    {
        $result   = [];
        $result[] = [false, ExpressionKind::None(), 2, 'The type of the expression is incompatible with the asserted type.'];
        $result[] = [true, ExpressionKind::IntegerConstant(), 0, null];

        return $result;
    }

    /**
     * @dataProvider ifTypeProvider
     *
     * @param bool           $expected
     * @param ExpressionKind $kind
     * @param int            $numErrors
     * @param string|null    $msg
     */
    public function testTryAssertTypeIfExpression(
        bool $expected,
        ExpressionKind $kind,
        int $numErrors,
        ?string $msg
    ) {
        $expressType = IExpression::class . ', ' . IPrimitiveValue::class;
        if (0 === $numErrors) {
            $expressType .= ', ' . IIntegerConstantExpression::class;
        }

        $trueExpression = m::mock($expressType);
        $trueExpression->shouldReceive('getExpressionKind')->andReturn($kind);
        $trueExpression->shouldReceive('getValueKind')->andReturn(ValueKind::Integer());
        $trueExpression->shouldReceive('Location')->andReturn(null);
        $trueExpression->shouldReceive('getType')->andReturn(null);
        $trueExpression->shouldReceive('getValue')->andReturn(0);

        $expression = m::mock(IIfExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::If());
        $expression->shouldReceive('Location')->andReturn(null);
        $expression->shouldReceive('getPath')->andReturn(['foo']);
        $expression->shouldReceive('getTrueExpression')->andReturn($trueExpression);
        $expression->shouldReceive('getFalseExpression')->andReturn($trueExpression);

        $defType = m::mock(IType::class);

        $type = m::mock(ITypeReference::class);
        $type->shouldReceive('TypeKind->IsNone')->andReturn(false)->once();
        $type->shouldReceive('getNullable')->andReturn(false);
        $type->shouldReceive('getDefinition')->andReturn($defType);
        $type->shouldReceive('isPrimitive')->andReturn(true);
        $type->shouldReceive('isIntegral')->andReturn(true);
        if (0 === $numErrors) {
            $type->shouldReceive('PrimitiveKind')->andReturn(PrimitiveTypeKind::Int32());
        }

        $rType = m::mock(IType::class);
        $rType->shouldReceive('getTypeKind->isNone')->andReturn(true)->once();

        $prop = m::mock(IProperty::class);
        $prop->shouldReceive('getType->getDefinition')->andReturn($rType)->once();

        $context = m::mock(IStructuredType::class);
        $context->shouldReceive('findProperty')->andReturn($prop)->once();

        $errors = [];
        $actual = ExpressionTypeChecker::tryAssertType($expression, $type, $context, false, $errors);
        $this->assertEquals($expected, $actual);
        $this->assertEquals($numErrors, count($errors));
        foreach ($errors as $error) {
            $this->assertEquals($msg, $error->getErrorMessage());
        }
    }
}
