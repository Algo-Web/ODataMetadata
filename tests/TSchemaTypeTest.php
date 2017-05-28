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

    public function testGetRandMaximum()
    {
        $type = new TSchemaType();
        $expectedMax = 1;
        $actualMax = -2;
        for ($i = 0; $i < 100; $i++) {
            $actualMax = max($type->getRand(), $actualMax);
        }
        $this->assertTrue($expectedMax >= $actualMax, $actualMax . " must be less than ".$expectedMax);
    }

    public function testGetRandMinimum()
    {
        $type = new TSchemaType();
        $expectedMin = 0;
        $actualMin = 2;
        for ($i = 0; $i < 100; $i++) {
            $actualMin = min($type->getRand(), $actualMin);
        }
        $this->assertTrue($expectedMin <= $actualMin, $actualMin . " must be less than ".$expectedMin);
    }
}
