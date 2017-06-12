<?php

namespace AlgoWeb\ODataMetadata\Tests\v3\edm;

use AlgoWeb\ODataMetadata\MetadataV3\edm\TEntityTypeType;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class TEntityTypeTypeTest extends TestCase
{
    public function testSetBaseTypeBadData()
    {
        $expected = "Base type must be a valid TQualifiedName";
        $actual = null;
        $foo = new TEntityTypeType();
        $baseType = " _ ";

        try {
            $foo->setBaseType($baseType);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testIsDerivableTypeAttributesValidNewCreation()
    {
        $expected = "Name cannot be null: AlgoWeb\\ODataMetadata\\MetadataV3\\edm\\TEntityTypeType";
        $actual = null;
        $foo = new TEntityTypeType();

        try {
            $foo->isTDerivableTypeAttributesValid($actual);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testIsDerivableTypeAttributesValidNameGoodBaseTypeNotGood()
    {
        $expectedStarts = "Base type must be a valid TQualifiedName:";
        $expectedEnds = "AlgoWeb_ODataMetadata_MetadataV3_edm_TEntityTypeType";
        $actual = null;
        $foo = m::mock(TEntityTypeType::class)->makePartial();
        $foo->shouldReceive('isTQualifiedNameValid')->withAnyArgs()->andReturn(true, false)->twice();
        $foo->shouldReceive('isTTypeAttributesValid')->andReturn(true)->atLeast(1);

        $foo->setName('Name');
        $foo->setBaseType('baseType');

        try {
            $foo->isTDerivableTypeAttributesValid($actual);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertStringStartsWith($expectedStarts, $actual);
        $this->assertStringEndsWith($expectedEnds, $actual);
    }

    public function testSetNameNull()
    {
        $expected = "Name cannot be null";
        $actual = null;
        $name = null;

        $foo = new TEntityTypeType();

        try {
            $foo->setName($name);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testSetNameNonString()
    {
        $expected = "Name must be a valid TSimpleIdentifier";
        $actual = null;
        $name = new \DateTime();

        $foo = new TEntityTypeType();

        try {
            $foo->setName($name);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testIsTTypeAttributesValidNameNotSimpleIdentifier()
    {
        $expectedStarts = "Name must be a valid TSimpleIdentifier:";
        $expectedEnds = "AlgoWeb_ODataMetadata_MetadataV3_edm_TEntityTypeType";
        $actual = null;
        $name = " _ ";

        $foo = m::mock(TEntityTypeType::class)->makePartial();
        $foo->shouldReceive('isTSimpleIdentifierValid')->withAnyArgs()->andReturn(true, false)->twice();
        $foo->setName($name);

        $foo->isTTypeAttributesValid($actual);
        $this->assertStringStartsWith($expectedStarts, $actual);
        $this->assertStringEndsWith($expectedEnds, $actual);
    }
}
