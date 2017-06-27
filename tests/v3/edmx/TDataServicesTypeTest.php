<?php

namespace AlgoWeb\ODataMetadata\Tests\v3\edmx;

use AlgoWeb\ODataMetadata\MetadataV3\edmx\TDataServicesType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Schema;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class TDataServicesTypeTest extends TestCase
{
    public function testServiceVersionGreaterThanMaxVersionWithIntegerVersions()
    {
        $expected = "Data service version cannot be greater than maximum service version";
        $actual = null;

        try {
            new TDataServicesType('3.0', '4.0');
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testServiceVersionGreaterThanMaxVersionWithNonIntegerVersions()
    {
        $expected = "Data service version cannot be greater than maximum service version";
        $actual = null;

        try {
            new TDataServicesType('3.1', '3.4');
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testMaxServiceVersionNotNumeric()
    {
        $expected = "Maximum service version must be numeric";
        $actual = null;

        try {
            new TDataServicesType(new \DateTime(), '3.4');
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testDataServiceVersionNotNumeric()
    {
        $expected = "Data service version must be numeric";
        $actual = null;

        try {
            new TDataServicesType('3.4', new \DateTime());
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testMaxDataServiceVersionOutOfRange()
    {
        $expected = "Maximum data service version must be 3.0 or 4.0";
        $actual = null;

        try {
            new TDataServicesType('2.0', '2.0');
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testDataServiceVersionOutOfRange()
    {
        $expected = "Data service version must be 1.0, 2.0, 3.0 or 4.0";
        $actual = null;

        try {
            new TDataServicesType('3.0', '0.5');
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testShouldNotBeAbleToSetEmptySchemaArray()
    {
        $expected = "Data services array not a valid array";
        $actual = null;

        $foo = new TDataServicesType();

        try {
            $foo->setSchema([]);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testTryToAddBadSchema()
    {
        $expected = "";
        $actual = null;

        $schema = m::mock(Schema::class);
        $schema->shouldReceive('isOK')->andReturn(false)->once();

        $foo = new TDataServicesType();
        try {
            $foo->addToSchema($schema);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }


    public function testCheckSchemaExists()
    {
        $foo = new TDataServicesType();
        $this->assertFalse($foo->issetSchema(1));
    }

    public function testUnsetMissingSchema()
    {
        $foo = new TDataServicesType();
        $foo->unsetSchema(1);
        $this->assertTrue(true);
    }

    public function testSetHigherDataThanDefaultMaxServiceVersionNotOK()
    {
        $expected = "Data service version cannot be greater than maximum service version";
        $actual = null;

        $foo = new TDataServicesType();
        $foo->setDataServiceVersion('4.0');
        $this->assertFalse($foo->isOK($actual));
        $this->assertEquals($expected, $actual);
    }

    public function testIsOKWhenSchemaNotOk()
    {
        $expected = "";
        $actual = null;

        $schema = m::mock(Schema::class);
        $schema->shouldReceive('isOK')->andReturn(true, false)->twice();
        $foo = new TDataServicesType();
        $foo->addToSchema($schema);
        $this->assertFalse($foo->isOK($actual));
        $this->assertEquals($expected, $actual);
    }
}
