<?php

namespace AlgoWeb\ODataMetadata\Tests\v3\edm\EntityContainer;

use AlgoWeb\ODataMetadata\MetadataV3\edm\EntityContainer\EntitySetAnonymousType;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class EntitySetAnonymousTypeTest extends TestCase
{
    public function testSetBadName()
    {
        $expected = "Name must be a valid TSimpleIdentifier";
        $actual = null;

        $foo = new EntitySetAnonymousType();
        $name = " _ ";

        try {
            $foo->setName($name);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testSetBadEntityType()
    {
        $expected = "Entity type must be a valid TQualifiedName";
        $actual = null;

        $foo = new EntitySetAnonymousType();
        $name = " _ ";

        try {
            $foo->setEntityType($name);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testSetBadGetterAccess()
    {
        $expected = "Getter access must be a valid TAccess";
        $actual = null;

        $foo = new EntitySetAnonymousType();
        $name = " _ ";

        try {
            $foo->setGetterAccess($name);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testIsTEntitySetAttributesOKBadName()
    {
        $expectedStarts = "Name must be a valid TSimpleIdentifier";
        $expectedEnds = "AlgoWeb_ODataMetadata_MetadataV3_edm_EntityContainer_EntitySetAnonymousType";
        $actual = null;

        $foo = m::mock(EntitySetAnonymousType::class)->makePartial();
        $foo->shouldReceive('isTSimpleIdentifierValid')->andReturn(true, false)->twice();
        
        $foo->setName(" _ ");
        
        $this->assertFalse($foo->isTEntitySetAttributesOK($actual));
        $this->assertStringStartsWith($expectedStarts, $actual);
        $this->assertStringEndsWith($expectedEnds, $actual);
    }

    public function testIsTEntitySetAttributesOKBadEntityType()
    {
        $expectedStarts = "Entity type must be a valid TQualifiedName";
        $expectedEnds = "AlgoWeb_ODataMetadata_MetadataV3_edm_EntityContainer_EntitySetAnonymousType";
        $actual = null;

        $foo = m::mock(EntitySetAnonymousType::class)->makePartial();
        $foo->shouldReceive('isTQualifiedNameValid')->andReturn(true, false)->twice();

        $foo->setEntityType(" _ ");

        $this->assertFalse($foo->isTEntitySetAttributesOK($actual));
        $this->assertStringStartsWith($expectedStarts, $actual);
        $this->assertStringEndsWith($expectedEnds, $actual);
    }

    public function testIsTEntitySetAttributesOKBadGetterAccess()
    {
        $expectedStarts = "Getter access must be a valid TAccess";
        $expectedEnds = "AlgoWeb_ODataMetadata_MetadataV3_edm_EntityContainer_EntitySetAnonymousType";
        $actual = null;

        $foo = m::mock(EntitySetAnonymousType::class)->makePartial();
        $foo->shouldReceive('isTAccessOk')->andReturn(true, false)->twice();

        $foo->setGetterAccess(" _ ");

        $this->assertFalse($foo->isTEntitySetAttributesOK($actual));
        $this->assertStringStartsWith($expectedStarts, $actual);
        $this->assertStringEndsWith($expectedEnds, $actual);
    }
}
