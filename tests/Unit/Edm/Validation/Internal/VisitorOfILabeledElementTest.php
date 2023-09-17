<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 6/07/20
 * Time: 2:31 PM.
 */

namespace AlgoWeb\ODataMetadata\Tests\Unit\Edm\Validation\Internal;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator\VisitorOfILabeledElement;
use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\ILabeledExpression;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class VisitorOfILabeledElementTest extends TestCase
{
    public function testVisitWithNonNullExpressionKind()
    {
        $item = m::mock(ILabeledExpression::class);
        $item->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::IntegerConstant());

        $followUp   = [];
        $references = [];

        $foo = new VisitorOfILabeledElement();

        $foo->visit($item, $followUp, $references);
        $this->assertEquals(1, count($followUp));
    }
}
