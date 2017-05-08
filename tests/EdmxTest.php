<?php

namespace AlgoWeb\ODataMetadata\Tests;

use AlgoWeb\ODataMetadata\MetadataV3\edmx\Edmx;

class EdmxTest extends TestCase
{
    public function testIsOKAtDefault()
    {
        $msg = null;
        $edmx = new Edmx();
        $this->assertTrue($edmx->isOK($msg), $msg);
    }
}
