<?php

namespace AlgoWeb\ODataMetadata\Tests;

use AlgoWeb\ODataMetadata\MetadataV3\edm\TAnnotationsType;

class TAnnotationsTypeTest extends TestCase
{
    public function testTPathFromKnownDocument()
    {
        $foo = new TAnnotationsType();
        $name = "ODataDemo.Product/Name";
        $this->assertTrue($foo->isTPathValid($name));
    }
}
