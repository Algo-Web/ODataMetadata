<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 4/07/20
 * Time: 4:29 PM
 */

namespace AlgoWeb\ODataMetadata\Tests\Unit\Edm\Validation\Internal;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;
use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator\VisitorOfIExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IExpression;
use AlgoWeb\ODataMetadata\Interfaces\ICheckable;
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
}
