<?php

namespace AlgoWeb\ODataMetadata\Tests\v3\edm;

use AlgoWeb\ODataMetadata\MetadataV3\edm\TEnumTypeMemberType;
use AlgoWeb\ODataMetadata\Tests\TestCase;

class TEnumTypeMemberTypeTest extends TestCase
{
    public function testPreserveString()
    {
        $foo = new TEnumTypeMemberType();
        $expected = " string ";
        $actual = $foo->preserveString($expected);
        $this->assertEquals($expected, $actual);
    }
}
