<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 5/07/20
 * Time: 2:04 PM.
 */
namespace AlgoWeb\ODataMetadata\Tests\Unit\Edm\Validation\Internal;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator\VisitorOfIPropertyConstructor;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\RecordExpression\IPropertyConstructor;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class VisitorOfIPropertyConstructorTest extends TestCase
{
    public function testVisitNullNameAndValue()
    {
        $item = m::mock(IPropertyConstructor::class)->makePartial();
        $item->shouldReceive('getName')->andReturn(null)->atLeast(1);
        $item->shouldReceive('getValue')->andReturn(null)->atLeast(1);
        $followUp   = [];
        $references = [];

        $foo    = new VisitorOfIPropertyConstructor();
        $result = $foo->visit($item, $followUp, $references);
        $this->assertTrue(is_array($result));
        $this->assertEquals(2, count($result));
    }
}
