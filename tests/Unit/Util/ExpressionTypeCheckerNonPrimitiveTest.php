<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 27/06/20
 * Time: 8:43 PM
 */

namespace AlgoWeb\ODataMetadata\Tests\Unit\Util;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;
use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Enums\TypeKind;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\INullExpression;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use AlgoWeb\ODataMetadata\Util\ExpressionTypeChecker;
use Mockery as m;

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
        $actual = ExpressionTypeChecker::tryAssertType($expression, $type, null, false, $errors);
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
        $actual = ExpressionTypeChecker::tryAssertType($expression, $type, null, false, $errors);
        $this->assertEquals($expected, $actual);
        $this->assertEquals(1, count($errors));

        /** @var EdmError $error */
        $error = $errors[0];

        $expected = 'Null value cannot have a non-nullable type.';
        $actual = $error->getErrorMessage();
        $this->assertEquals($expected, $actual);
    }
}
