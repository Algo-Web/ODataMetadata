<?php

namespace AlgoWeb\ODataMetadata\Tests\v3\edm;

use AlgoWeb\ODataMetadata\MetadataV3\edm\TEnumTypeType;
use AlgoWeb\ODataMetadata\Tests\TestCase;

class TEnumTypeTypeTest extends TestCase
{
    public function testIsEDMSimpleTypeValidNonString()
    {
        $expected = "Input must be a string: AlgoWeb\\ODataMetadata\\MetadataV3\\edm\\TEnumTypeType";
        $actual = null;

        $type = new \DateTime();
        $foo = new TEnumTypeType();

        try {
            $foo->isEDMSimpleTypeValid($type);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }
}