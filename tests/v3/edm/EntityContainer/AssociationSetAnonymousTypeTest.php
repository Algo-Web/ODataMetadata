<?php

namespace AlgoWeb\ODataMetadata\Tests\v3\edm\EntityContainer;

use AlgoWeb\ODataMetadata\Tests\TestCase;
use AlgoWeb\ODataMetadata\MetadataV3\edm\EntityContainer\AssociationSetAnonymousType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\EntityContainer\AssociationSetAnonymousType\EndAnonymousType;
use Mockery as m;

class AssociationSetAnonymousTypeTest extends TestCase
{
    public function testSetBadName()
    {
        $expected = "Name must be a valid TSimpleIdentifier";
        $actual = null;

        $foo = new AssociationSetAnonymousType();

        try {
            $foo->setName(" _ ");
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testSetBadAssociation()
    {
        $expected = "Association must be a valid TQualifiedName";
        $actual = null;

        $foo = new AssociationSetAnonymousType();

        try {
            $foo->setAssociation(" _ ");
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testAddBadEnd()
    {
        $expected = "";
        $actual = null;

        $end = m::mock(EndAnonymousType::class);
        $end->shouldReceive('isOK')->andReturn(false);

        $foo = new AssociationSetAnonymousType();

        try {
            $foo->addToEnd($end);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testSetBadEnd()
    {
        $expected = "";
        $actual = null;

        $end = m::mock(EndAnonymousType::class);
        $end->shouldReceive('isOK')->andReturn(false);

        $foo = new AssociationSetAnonymousType();

        try {
            $foo->setEnd([$end]);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testAddGoodEnd()
    {
        $end = m::mock(EndAnonymousType::class);
        $end->shouldReceive('isOK')->andReturn(true);

        $foo = new AssociationSetAnonymousType();

        $foo->addToEnd($end);
        $this->assertTrue($foo->issetEnd(0));
        $foo->unsetEnd(0);
        $this->assertFalse($foo->issetEnd(0));
    }

    public function testIsOKNewObject()
    {
        $expected = "Name must be a valid TSimpleIdentifier";
        $actual = null;

        $foo = new AssociationSetAnonymousType();
        $this->assertFalse($foo->isOK($actual));
        $this->assertEquals($expected, $actual);
    }

    public function testIsOKMissingAssociation()
    {
        $expected = "Association must be a valid TQualifiedName";
        $actual = null;

        $foo = new AssociationSetAnonymousType();
        $foo->setName('UnitPrice');
        $this->assertFalse($foo->isOK($actual));
        $this->assertEquals($expected, $actual);
    }

    public function testTooManyEnds()
    {
        $expected = "Supplied array not a valid array: ".
                    'AlgoWeb\ODataMetadata\MetadataV3\edm\EntityContainer\AssociationSetAnonymousType';
        $actual = null;

        $end = m::mock(EndAnonymousType::class);
        $end->shouldReceive('isOK')->andReturn(true);

        $foo = new AssociationSetAnonymousType();
        $foo->setName('UnitPrice');
        $foo->setAssociation("Org.OData.Publication.V1.DocumentationUrl");
        $foo->addToEnd($end);
        $foo->addToEnd($end);
        $foo->addToEnd($end);
        $this->assertFalse($foo->isOK($actual));
        $this->assertEquals($expected, $actual);
    }
}
