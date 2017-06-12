<?php

namespace AlgoWeb\ODataMetadata\Tests\v3\edm;

use AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionType;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class TFunctionTypeTest extends TestCase
{
    public function testIsSridFacetValidNonNegativeInteger()
    {
        $foo = m::mock(TFunctionType::class)->makePartial();
        $foo->shouldReceive('isTVariableValid')->andReturn(false)->once();
        $this->assertTrue($foo->isTSridFacetValid('6'));
    }

    public function testIsSridFacetValidNegativeInteger()
    {
        $expected = "Input must be non-negative integer";
        $actual = null;

        $foo = m::mock(TFunctionType::class)->makePartial();
        $foo->shouldReceive('isTVariableValid')->andReturn(false)->once();

        try {
            $foo->isTSridFacetValid('-6');
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testIsSridFacetValidNonNegativeFloat()
    {
        $expected = "Input must be integer";
        $actual = null;

        $foo = m::mock(TFunctionType::class)->makePartial();
        $foo->shouldReceive('isTVariableValid')->andReturn(false)->once();
        try {
            $foo->isTSridFacetValid('6.5');
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testIsSridFacetValidNegativeFloat()
    {
        $expected = "Input must be integer";
        $actual = null;

        $foo = m::mock(TFunctionType::class)->makePartial();
        $foo->shouldReceive('isTVariableValid')->andReturn(false)->once();

        try {
            $foo->isTSridFacetValid('-6.5');
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testIsSridFacetValidNonString()
    {
        $expected = "Input must be a string";
        $actual = null;

        $foo = m::mock(TFunctionType::class)->makePartial();
        $foo->shouldReceive('isTVariableValid')->andReturn(false)->once();

        try {
            $foo->isTSridFacetValid(new \DateTime());
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testPreserveStringNotAString()
    {
        $expected = "Input must be a string";
        $actual = null;

        $foo = m::mock(TFunctionType::class)->makePartial();
        $foo->shouldReceive('isTVariableValid')->andReturn(false)->once();

        try {
            $foo->preserveString(new \DateTime());
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testReplaceStringNotAString()
    {
        $expected = "Input must be a string";
        $actual = null;

        $foo = m::mock(TFunctionType::class)->makePartial();
        $foo->shouldReceive('isTVariableValid')->andReturn(false)->once();

        try {
            $foo->replaceString(new \DateTime());
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }
}
