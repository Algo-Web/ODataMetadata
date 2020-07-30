<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 6/07/20
 * Time: 3:43 PM.
 */

namespace AlgoWeb\ODataMetadata\Tests\Unit\Edm\Validation\Internal;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;
use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator\VisitorOfIParameterReferenceExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IParameterReferenceExpression;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionParameter;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class VisitorOfIParameterReferenceExpressionTest extends TestCase
{
    public function testVisitWithNullReferencedParameter()
    {
        $item = m::mock(IParameterReferenceExpression::class);
        $item->shouldReceive('getReferencedParameter')->andReturn(null);

        $followUp   = [];
        $references = [];

        $foo = new VisitorOfIParameterReferenceExpression();

        $result = $foo->visit($item, $followUp, $references);
        $this->assertTrue(is_array($result));
        $this->assertEquals(1, count($result));
        /** @var EdmError $error */
        $error = $result[0];

        $expectedErrorCode = EdmErrorCode::InterfaceCriticalPropertyValueMustNotBeNull();
        $this->assertEquals($expectedErrorCode, $error->getErrorCode());
        $expected = 'ODataMetadata_Interfaces_Expressions_IParameterReferenceExpression.ReferencedParameter\' must not be null.';
        $this->assertContains($expected, $error->getErrorMessage());
    }

    public function testVisitWithNonNullReferencedParameter()
    {
        $refParm = m::mock(IFunctionParameter::class);

        $item = m::mock(IParameterReferenceExpression::class);
        $item->shouldReceive('getReferencedParameter')->andReturn($refParm);

        $followUp   = [];
        $references = [];

        $foo = new VisitorOfIParameterReferenceExpression();

        $result = $foo->visit($item, $followUp, $references);
        $this->assertNull($result);
        $this->assertEquals(1, count($references));
    }
}
