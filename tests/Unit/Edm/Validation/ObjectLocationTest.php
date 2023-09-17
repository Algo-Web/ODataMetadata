<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 30/07/20
 * Time: 9:51 PM.
 */

namespace AlgoWeb\ODataMetadata\Tests\Unit\Edm\Validation;

use AlgoWeb\ODataMetadata\Edm\Validation\ObjectLocation;
use AlgoWeb\ODataMetadata\Interfaces\IEntityType;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class ObjectLocationTest extends TestCase
{
    public function testToString()
    {
        $obj = m::mock(IEntityType::class);
        $obj->shouldReceive('__toString')->andReturn('rhubarb');

        $foo = new ObjectLocation($obj);

        $expected = 'rhubarb';
        $actual   = $foo->__toString();
        $this->assertEquals($expected, $actual);

        $actual = $foo->getObject()->__toString();
        $this->assertEquals($expected, $actual);
    }
}
