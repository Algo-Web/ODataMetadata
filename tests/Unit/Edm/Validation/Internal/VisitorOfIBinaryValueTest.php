<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 5/07/20
 * Time: 1:59 PM.
 */
namespace AlgoWeb\ODataMetadata\Tests\Unit\Edm\Validation\Internal;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator\VisitorOfIBinaryValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\IBinaryValue;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class VisitorOfIBinaryValueTest extends TestCase
{
    public function testVisitNullValue()
    {
        $item = m::mock(IBinaryValue::class)->makePartial();
        $item->shouldReceive('getValue')->andReturn(null)->atLeast(1);
        $followUp   = [];
        $references = [];

        $foo    = new VisitorOfIBinaryValue();
        $result = $foo->visit($item, $followUp, $references);
        $this->assertTrue(is_array($result));
        $this->assertEquals(1, count($result));
    }
}
