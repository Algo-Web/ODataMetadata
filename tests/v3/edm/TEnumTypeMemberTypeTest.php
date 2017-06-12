<?php

namespace AlgoWeb\ODataMetadata\Tests\v3\edm;

use AlgoWeb\ODataMetadata\MetadataV3\edm\TDocumentationType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TEnumTypeMemberType;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class TEnumTypeMemberTypeTest extends TestCase
{
    public function testPreserveString()
    {
        $foo = new TEnumTypeMemberType();
        $expected = " string ";
        $actual = $foo->preserveString($expected);
        $this->assertEquals($expected, $actual);
    }

    public function testSetDocumentationNotOk()
    {
        $expected = "";
        $actual = null;
        $foo = new TEnumTypeMemberType();
        $documentation = m::mock(TDocumentationType::class);
        $documentation->shouldReceive('isOK')->andReturn(false)->once();

        try {
            $foo->setDocumentation($documentation);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testIsExtensibilityElementOKNoGoodnik()
    {
        $expected = "";
        $actual = null;
        $foo = new TEnumTypeMemberType();
        $documentation = m::mock(TDocumentationType::class);
        $documentation->shouldReceive('isOK')->andReturn(true, false)->twice();

        $foo->setDocumentation($documentation);
        $this->assertFalse($foo->isExtensibilityElementOK($actual));
        $this->assertEquals($expected, $actual);
    }
}
