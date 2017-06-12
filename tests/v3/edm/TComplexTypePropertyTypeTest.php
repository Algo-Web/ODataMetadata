<?php

namespace AlgoWeb\ODataMetadata\Tests\v3\edm;

use AlgoWeb\ODataMetadata\MetadataV3\edm\TComplexTypePropertyType;
use AlgoWeb\ODataMetadata\Tests\TestCase;

class TComplexTypePropertyTypeTest extends TestCase
{
    public function testConcurrencyModeNonString()
    {
        $foo = new TComplexTypePropertyType();

        $mode = new \DateTime();
        $expected = "Input must be a string: AlgoWeb\\ODataMetadata\\MetadataV3\\edm\\TComplexTypePropertyType";
        $actual = null;

        try {
            $foo->isTConcurrencyModeValid($mode);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testConcurrencyModeFixed()
    {
        $foo = new TComplexTypePropertyType();

        $mode = "Fixed";
        $this->assertTrue($foo->isTConcurrencyModeValid($mode));
    }

    public function testConcurrencyModeNone()
    {
        $foo = new TComplexTypePropertyType();

        $mode = "None";
        $this->assertTrue($foo->isTConcurrencyModeValid($mode));
    }
}
