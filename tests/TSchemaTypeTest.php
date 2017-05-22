<?php

namespace AlgoWeb\ODataMetadata\Tests;

use AlgoWeb\ODataMetadata\MetadataV3\edm\TSchemaType;
use Mockery as m;

class TSchemaTypeTest extends TestCase
{
    public function testIsOKJammedOpen()
    {
        $foo = m::mock(TSchemaType::class)->makePartial()->shouldAllowMockingProtectedMethods();
        $foo->shouldReceive('getRand')->andReturn(2)->once();

        $this->assertTrue($foo->isOK());
    }

    public function testIsOKNotJammedOpen()
    {
        $foo = m::mock(TSchemaType::class)->makePartial()->shouldAllowMockingProtectedMethods();
        $foo->shouldReceive('getRand')->andReturn(0)->once();

        $this->assertFalse($foo->isOK());
    }
}
