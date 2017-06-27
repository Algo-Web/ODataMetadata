<?php

namespace AlgoWeb\ODataMetadata\Tests\v3\edmx;

use AlgoWeb\ODataMetadata\MetadataV3\edmx\TDataServicesType;
use AlgoWeb\ODataMetadata\MetadataV3\edmx\TDesignerType;
use AlgoWeb\ODataMetadata\MetadataV3\edmx\TEdmxType;
use AlgoWeb\ODataMetadata\MetadataV3\edmx\TRuntimeType;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class TEdmxTypeTest extends TestCase
{
    public function testSetEmptyVersion()
    {
        $version = " ";
        $foo = new TEdmxType();

        $expected = "Version cannot be null or empty";
        $actual = null;

        try {
            $foo->setVersion($version);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testSetDataServiceTypeNotOK()
    {
        $dataServiceType = m::mock(TDataServicesType::class);
        $dataServiceType->shouldReceive('isOK')->andReturn(false)->once();
        $foo = new TEdmxType();

        $expected = "";
        $actual = null;

        try {
            $foo->setDataServiceType($dataServiceType);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testSetDesignerTypeNotOK()
    {
        $designer = m::mock(TDesignerType::class);
        $designer->shouldReceive('isOK')->andReturn(false)->once();
        $foo = new TEdmxType();

        $expected = "";
        $actual = null;

        try {
            $foo->setDesigner($designer);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testSetDesignerTypeOK()
    {
        $designer = m::mock(TDesignerType::class);
        $designer->shouldReceive('isOK')->andReturn(true)->twice();
        $foo = new TEdmxType();

        $foo->setDesigner($designer);
        $this->assertTrue($foo->getDesigner()->isOK());
    }

    public function testSetRuntimeNotOK()
    {
        $runtime = m::mock(TRuntimeType::class);
        $runtime->shouldReceive('isOK')->andReturn(false)->once();
        $foo = new TEdmxType();

        $expected = "";
        $actual = null;

        try {
            $foo->setRuntime($runtime);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testSetRuntimeOK()
    {
        $runtime = m::mock(TRuntimeType::class);
        $runtime->shouldReceive('isOK')->andReturn(true)->twice();
        $foo = new TEdmxType();

        $foo->setRuntime($runtime);
        $this->assertTrue($foo->getRuntime()->isOK());
    }

    public function testIsNewObjectOK()
    {
        $expected = "Version cannot be null or empty";
        $actual = null;
        $foo = new TEdmxType();

        $this->assertFalse($foo->isOK($actual));
        $this->assertEquals($expected, $actual);
    }

    public function testIsObjectWithoutDataServiceOK()
    {
        $expected = "Data service type cannot be null";
        $actual = null;
        $foo = new TEdmxType();
        $foo->setVersion("1.5");

        $this->assertFalse($foo->isOK($actual));
        $this->assertEquals($expected, $actual);
    }

    public function testIsObjectWithBadDataServiceOK()
    {
        $unwanted2 = "Version cannot be null or empty";
        $actual = null;
        $dataServiceType = m::mock(TDataServicesType::class);
        $dataServiceType->shouldReceive('isOK')->andReturn(true, false)->twice();
        $foo = new TEdmxType();
        $foo->setVersion("1.5");
        $foo->setDataServiceType($dataServiceType);

        $this->assertFalse($foo->isOK($actual));
        $this->assertNotEquals($unwanted2, $actual);
    }


    public function testIsObjectWithBadDesignerServiceOK()
    {
        $unwanted = "Data service type cannot be null";
        $unwanted2 = "Version cannot be null or empty";
        $actual = null;
        $designer = m::mock(TDesignerType::class);
        $designer->shouldReceive('isOK')->andReturn(true, false)->twice();
        $dataServiceType = m::mock(TDataServicesType::class);
        $dataServiceType->shouldReceive('isOK')->andReturn(true)->once();
        $foo = new TEdmxType();
        $foo->setVersion("1.5");
        $foo->setDataServiceType($dataServiceType);
        $foo->setDesigner($designer);

        $this->assertFalse($foo->isOK($actual));
        $this->assertNotEquals($unwanted, $actual);
        $this->assertNotEquals($unwanted2, $actual);
    }

    public function testIsObjectWithBadRuntimeServiceOK()
    {
        $unwanted = "Data service type cannot be null";
        $unwanted2 = "Version cannot be null or empty";
        $actual = null;
        $runtime = m::mock(TRuntimeType::class);
        $runtime->shouldReceive('isOK')->andReturn(true, false)->twice();
        $dataServiceType = m::mock(TDataServicesType::class);
        $dataServiceType->shouldReceive('isOK')->andReturn(true)->once();
        $foo = new TEdmxType();
        $foo->setVersion("1.5");
        $foo->setDataServiceType($dataServiceType);
        $foo->setRuntime($runtime);

        $this->assertFalse($foo->isOK($actual));
        $this->assertNotEquals($unwanted, $actual);
        $this->assertNotEquals($unwanted2, $actual);
    }
}
