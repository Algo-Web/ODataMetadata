<?php

declare(strict_types=1);


namespace Unit\Util;

use AlgoWeb\ODataMetadata\Tests\TestCase;
use AlgoWeb\ODataMetadata\Util\UnmanagedByteArray;

class UnmanagedByteArrayTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testGetValues()
    {
        $stream    = fopen('php://memory', 'r+');
        $byteArray = new UnmanagedByteArray($stream, false);
        $this->assertEquals(0, count($byteArray));
        $testArray = [];
        for ($i = 0; $i < 50; $i++) {
            $val         = rand(0, 254);
            $byteArray[] = $val;
            $testArray[] = $val;
        }
        $this->assertEquals(50, count($byteArray));
        for ($i = 0; $i < 50; $i++) {
            $this->assertEquals($testArray[$i], $byteArray[$i]);
        }
    }
}
