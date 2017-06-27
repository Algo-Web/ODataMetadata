<?php

namespace AlgoWeb\ODataMetadata\Tests\v3\edmx;

use AlgoWeb\ODataMetadata\MetadataV3\edmx\TDataServicesType;
use AlgoWeb\ODataMetadata\Tests\TestCase;

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
}
