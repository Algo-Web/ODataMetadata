<?php

namespace AlgoWeb\ODataMetadata\Tests;

class MappingTypeTests extends TestCase
{
    public function testSimpleIdentifierValidWithTrailingSpace()
    {
        $string = "UnitPrice ";
        $foo = new mappingTestType();
        $this->assertFalse($foo->isTSimpleIdentifierValid($string));
    }

    public function testSimpleIdentifierValidWithoutTrailingSpace()
    {
        $string = "UnitPrice";

        $foo = new mappingTestType();
        $this->assertTrue($foo->isTSimpleIdentifierValid($string));
    }
}
