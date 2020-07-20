<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 5/07/20
 * Time: 1:59 PM.
 */
namespace AlgoWeb\ODataMetadata\Tests\Unit\Edm\Validation\Internal;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator\VisitorOfIStringValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\IStringValue;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class VisitorOfIStringValueTest extends TestCase
{
    public function testVisitNullValue()
    {
        $item = m::mock(IStringValue::class)->makePartial();
        $item->shouldReceive('getValue')->andReturn(null)->atLeast(1);
        $followUp   = [];
        $references = [];

        $foo    = new VisitorOfIStringValue();
        $result = $foo->Visit($item, $followUp, $references);
        $this->assertTrue(is_array($result));
        $this->assertEquals(1, count($result));
    }
}
