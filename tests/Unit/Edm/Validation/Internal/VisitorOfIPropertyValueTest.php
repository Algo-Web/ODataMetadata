<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 5/07/20
 * Time: 2:02 PM
 */

namespace AlgoWeb\ODataMetadata\Tests\Unit\Edm\Validation\Internal;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator\VisitorOfIPropertyValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\IPropertyValue;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class VisitorOfIPropertyValueTest extends TestCase
{
    public function testVisitNullName()
    {
        $item = m::mock(IPropertyValue::class)->makePartial();
        $item->shouldReceive('getName')->andReturn(null)->atLeast(1);
        $followUp   = [];
        $references = [];

        $foo = new VisitorOfIPropertyValue();
        $result = $foo->Visit($item, $followUp, $references);
        $this->assertTrue(is_array($result));
        $this->assertEquals(1, count($result));
    }
}
