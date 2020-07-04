<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 4/07/20
 * Time: 4:29 PM
 */

namespace AlgoWeb\ODataMetadata\Tests\Unit\Edm\Validation\Internal;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;
use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator\VisitorOfIExpression;
use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IApplyExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IAssertTypeExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IBinaryConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IBooleanConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\ICollectionExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IDateTimeConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IDateTimeOffsetConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IDecimalConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IEntitySetReferenceExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IEnumMemberReferenceExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IFloatingConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IFunctionReferenceExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IGuidConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IIfExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IIntegerConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IIsTypeExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\ILabeledExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\ILabeledExpressionReferenceExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\INullExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IParameterReferenceExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IPathExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IPropertyReferenceExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IRecordExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IStringConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\ITimeConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IValueTermReferenceExpression;
use AlgoWeb\ODataMetadata\Interfaces\ICheckable;
use AlgoWeb\ODataMetadata\Interfaces\IProperty;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class VisitorOfIExpressionTest extends TestCase
{
    public function testVisitBadType()
    {
        $error = m::mock(EdmError::class);
        $item = m::mock(IExpression::class . ', ' . ICheckable::class);
        $item->shouldReceive('getErrors')->andReturn([$error])->atLeast(1);
        $followUp = [];
        $references = [];

        $this->assertTrue(InterfaceValidator::IsCheckableBad($item));

        $foo = new VisitorOfIExpression();
        $result = $foo->Visit($item, $followUp, $references);
        $this->assertNull($result);
    }

    public function testVisitBadExpressionKind()
    {
        $error = m::mock(EdmError::class);

        $exprKind = m::mock(ExpressionKind::class);
        $exprKind->shouldReceive('getKey')->andReturn(null);
        $exprKind->shouldReceive('getValue')->andReturn(null);
        $item = m::mock(IExpression::class);
        $item->shouldReceive('getExpressionKind')->andReturn($exprKind);

        $followUp = [];
        $references = [];

        $this->assertFalse(InterfaceValidator::IsCheckableBad($item));

        $foo = new VisitorOfIExpression();
        $result = $foo->Visit($item, $followUp, $references);
        $this->assertTrue(is_array($result));
        $this->assertEquals(1, count($result));

        /** @var EdmError $error */
        $error = $result[0];
        $this->assertEquals(EdmErrorCode::InterfaceCriticalKindValueUnexpected(), $error->getErrorCode());

        $expected = 'AlgoWeb_ODataMetadata_Interfaces_Expressions_IExpression.ExpressionKind\' is not'.
                    ' semantically valid. A semantically valid model must not contain elements of kind \'\'.';
        $actual = $error->getErrorMessage();
        $this->assertContains($expected, $actual);
    }

    public function expressionKindProvider(): array
    {
        $result = [];
        $result[] = [ExpressionKind::IntegerConstant(), IIntegerConstantExpression::class];
        $result[] = [ExpressionKind::StringConstant(), IStringConstantExpression::class];
        $result[] = [ExpressionKind::BinaryConstant(), IBinaryConstantExpression::class];
        $result[] = [ExpressionKind::BooleanConstant(), IBooleanConstantExpression::class];
        $result[] = [ExpressionKind::DateTimeConstant(), IDateTimeConstantExpression::class];
        $result[] = [ExpressionKind::DateTimeOffsetConstant(), IDateTimeOffsetConstantExpression::class];
        $result[] = [ExpressionKind::TimeConstant(), ITimeConstantExpression::class];
        $result[] = [ExpressionKind::DecimalConstant(), IDecimalConstantExpression::class];
        $result[] = [ExpressionKind::FloatingConstant(), IFloatingConstantExpression::class];
        $result[] = [ExpressionKind::GuidConstant(), IGuidConstantExpression::class];
        $result[] = [ExpressionKind::Null(), INullExpression::class];
        $result[] = [ExpressionKind::Record(), IRecordExpression::class];
        $result[] = [ExpressionKind::Collection(), ICollectionExpression::class];
        $result[] = [ExpressionKind::Path(), IPathExpression::class];
        $result[] = [ExpressionKind::ParameterReference(), IParameterReferenceExpression::class];
        $result[] = [ExpressionKind::FunctionReference(), IFunctionReferenceExpression::class];
        $result[] = [ExpressionKind::PropertyReference(), IPropertyReferenceExpression::class];
        $result[] = [ExpressionKind::ValueTermReference(), IValueTermReferenceExpression::class];
        $result[] = [ExpressionKind::EntitySetReference(), IEntitySetReferenceExpression::class];
        $result[] = [ExpressionKind::EnumMemberReference(), IEnumMemberReferenceExpression::class];
        $result[] = [ExpressionKind::If(), IIfExpression::class];
        $result[] = [ExpressionKind::AssertType(), IAssertTypeExpression::class];
        $result[] = [ExpressionKind::IsType(), IIsTypeExpression::class];
        $result[] = [ExpressionKind::FunctionApplication(), IApplyExpression::class];
        $result[] = [ExpressionKind::Labeled(), ILabeledExpression::class];
        $result[] = [ExpressionKind::LabeledExpressionReference(), ILabeledExpressionReferenceExpression::class];


        return $result;
    }

    /**
     * @dataProvider expressionKindProvider
     *
     * @param ExpressionKind $kind
     * @param string $mustImplement
     */
    public function testVisitWithGoodExpressionKind(ExpressionKind $kind, string $mustImplement)
    {
        $item = m::mock(IExpression::class);
        $item->shouldReceive('getExpressionKind')->andReturn($kind);

        $followUp = [];
        $references = [];

        $this->assertFalse(InterfaceValidator::IsCheckableBad($item));

        $foo = new VisitorOfIExpression();
        $result = $foo->Visit($item, $followUp, $references);
        $this->assertTrue(is_array($result));
        $this->assertEquals(1, count($result));

        /** @var EdmError $error */
        $error = $result[0];
        $this->assertEquals(EdmErrorCode::InterfaceCriticalKindValueMismatch(), $error->getErrorCode());

        $expected = 'IExpression.ExpressionKind\' property must implement \'' . $mustImplement . '\' interface.';
        $actual = $error->getErrorMessage();
        $this->assertContains($expected, $actual);
    }
}
