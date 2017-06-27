<?php

namespace AlgoWeb\ODataMetadata\Tests\v3\edm\EntityContainer\AssociationSetAnonymousType;

use AlgoWeb\ODataMetadata\MetadataV3\edm\EntityContainer\AssociationSetAnonymousType\EndAnonymousType;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class EndAnonymousTypeTest extends TestCase
{
    public function testSetBadRole()
    {
        $expected = "Role must be a valid TSimpleIdentifier";
        $actual = null;

        $foo = new EndAnonymousType();

        try {
            $foo->setRole(" _ ");
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testSetBadEntitySet()
    {
        $expected = "Entity set must be a valid TSimpleIdentifier";
        $actual = null;

        $foo = new EndAnonymousType();

        try {
            $foo->setEntitySet(" _ ");
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testNewCreationIsNotOK()
    {
        $expected = "Entity set must be a valid TSimpleIdentifier";
        $actual = null;

        $foo = new EndAnonymousType();
        $this->assertFalse($foo->isOK($actual));
        $this->assertEquals($expected, $actual);
    }

    public function testIsOkWithBadRole()
    {
        $expected = "Role must be a valid TSimpleIdentifier";
        $actual = null;

        $foo = m::mock(EndAnonymousType::class)->makePartial();
        $foo->shouldReceive('isTSimpleIdentifierValid')->andReturn(true, true, true, false)->times(4);
        $foo->setEntitySet("UnitPrice");
        $foo->setRole(" _ ");
        $this->assertFalse($foo->isOK($actual));
        $this->assertEquals($expected, $actual);
    }
}
