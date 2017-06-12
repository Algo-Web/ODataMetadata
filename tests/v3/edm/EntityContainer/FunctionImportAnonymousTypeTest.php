<?php

namespace AlgoWeb\ODataMetadata\Tests\v3\edm\EntityContainer;

use AlgoWeb\ODataMetadata\MetadataV3\edm\EntityContainer\FunctionImportAnonymousType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionImportReturnTypeType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TOperandType;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class FunctionImportAnonymousTypeTest extends TestCase
{
    public function testIsComposableRoundTripTrue()
    {
        $foo = new FunctionImportAnonymousType();

        $foo->setIsComposable('foo');
        $this->assertTrue($foo->getIsComposable());
    }

    public function testIsComposableRoundTripFalse()
    {
        $foo = new FunctionImportAnonymousType();

        $foo->setIsComposable(null);
        $this->assertFalse($foo->getIsComposable());
    }

    public function testIsSideEffectingRoundTripTrue()
    {
        $foo = new FunctionImportAnonymousType();

        $foo->setIsSideEffecting('foo');
        $this->assertTrue($foo->getIsSideEffecting());
    }

    public function testIsSideEffectingRoundTripFalse()
    {
        $foo = new FunctionImportAnonymousType();

        $foo->setIsSideEffecting(null);
        $this->assertFalse($foo->getIsSideEffecting());
    }

    public function testIsBindableRoundTripTrue()
    {
        $foo = new FunctionImportAnonymousType();

        $foo->setIsBindable('foo');
        $this->assertTrue($foo->getIsBindable());
    }

    public function testIsBindableRoundTripFalse()
    {
        $foo = new FunctionImportAnonymousType();

        $foo->setIsBindable(null);
        $this->assertFalse($foo->getIsBindable());
    }

    public function testMethodAccessRoundTrip()
    {
        $foo = new FunctionImportAnonymousType();

        $foo->setMethodAccess('Public');
        $this->assertEquals('Public', $foo->getMethodAccess());
    }

    public function testSetMethodAccessBadData()
    {
        $expected = "Method access must be a valid TAccess";
        $actual = null;

        $foo = new FunctionImportAnonymousType();

        try {
            $foo->setMethodAccess("cheezburger");
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testSetEntitySetBadData()
    {
        $expected = "";
        $actual = null;

        $entitySet = m::mock(TOperandType::class)->makePartial();
        $entitySet->shouldReceive('isOK')->andReturn(false)->once();

        $foo = new FunctionImportAnonymousType();

        try {
            $foo->setEntitySet($entitySet);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testSetEntitySetRoundTrip()
    {
        $entitySet = m::mock(TOperandType::class)->makePartial();
        $entitySet->shouldReceive('isOK')->andReturn(true)->twice();

        $foo = new FunctionImportAnonymousType();

        $foo->setEntitySet($entitySet);
        $result = $foo->getEntitySet();
        $this->assertTrue($result->isOK());
    }

    public function testAddToReturnTypeBadData()
    {
        $expected = "";
        $actual = null;

        $entitySet = m::mock(TFunctionImportReturnTypeType::class)->makePartial();
        $entitySet->shouldReceive('isOK')->andReturn(false)->once();

        $foo = new FunctionImportAnonymousType();

        try {
            $foo->addToReturnType($entitySet);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testUnsetMissingReturnTypeIndex()
    {
        $foo = new FunctionImportAnonymousType();

        $foo->unsetReturnType(0);
        $this->assertFalse($foo->issetReturnType(0));
    }

    public function testGetReturnTypeEmptyArray()
    {
        $foo = new FunctionImportAnonymousType();
        $this->assertEquals(0, count($foo->getReturnType()));
    }

    public function testSetReturnTypeBadData()
    {
        $expected = "";
        $actual = null;

        $entitySet = m::mock(TFunctionImportReturnTypeType::class)->makePartial();
        $entitySet->shouldReceive('isOK')->andReturn(false)->once();

        $foo = new FunctionImportAnonymousType();

        try {
            $foo->setReturnType([$entitySet]);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testSetNameBadData()
    {
        $expected = "Name must be a valid TSimpleIdentifier";
        $actual = null;

        $foo = new FunctionImportAnonymousType();

        try {
            $foo->setName(" _ ");
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testIsTFunctionImportAttributesValid()
    {
        $expected = "Name must be a valid TSimpleIdentifier:"
                    ." AlgoWeb\\ODataMetadata\\MetadataV3\\edm\\EntityContainer\\FunctionImportAnonymousType";
        $actual = null;

        $foo = new FunctionImportAnonymousType();
        $foo->isTFunctionImportAttributesValid($actual);
        $this->assertEquals($expected, $actual);
    }

    public function testIsComposableAndSideEffecting()
    {
        $expected = "Cannot both be composable and side-effecting";
        $actual = null;

        $foo = new FunctionImportAnonymousType();
        $foo->setName("Name");
        $foo->setIsComposable(true);
        $foo->setIsSideEffecting(true);

        $foo->isTFunctionImportAttributesValid($actual);
        $this->assertEquals($expected, $actual);
        $this->assertEquals("Name", $foo->getName());
    }

    public function testIsTFunctionImportAttributesValidWithAccessSet()
    {
        $foo = new FunctionImportAnonymousType();
        $foo->setName("Name");
        $foo->setMethodAccess('Public');

        $msg = null;
        $this->assertTrue($foo->isTFunctionImportAttributesValid($msg));
        $this->assertNull($msg);
    }

    public function testIsTFunctionImportAttributesValidWithBadEntitySet()
    {
        $expectedStarts = "Entity set must be either null or an instance of TOperandType:";
        $expectedEnds = "AlgoWeb\\ODataMetadata\\MetadataV3\\edm\\EntityContainer\\FunctionImportAnonymousType";
        $actual = null;

        $entitySet = m::mock(TOperandType::class)->makePartial();
        $entitySet->shouldReceive('isOK')->andReturn(true, false)->twice();

        $foo = new FunctionImportAnonymousType();
        $foo->setName("Name");
        $foo->setMethodAccess('Public');
        $foo->setEntitySet($entitySet);

        $this->assertFalse($foo->isTFunctionImportAttributesValid($actual));
        $this->assertStringStartsWith($expectedStarts, $actual);
        $this->assertStringEndsWith($expectedEnds, $actual);
    }

    public function testIsTFunctionImportAttributesValidWithBadReturnType()
    {
        $expected = "";
        $actual = null;

        $entitySet = m::mock(TFunctionImportReturnTypeType::class)->makePartial();
        $entitySet->shouldReceive('isOK')->andReturn(true, false)->once();

        $foo = new FunctionImportAnonymousType();
        $foo->setName("Name");
        $foo->setMethodAccess('Public');
        $foo->addToReturnType($entitySet);

        $this->assertFalse($foo->isTFunctionImportAttributesValid($actual));
        $this->assertEquals($expected, $actual);
    }
}
