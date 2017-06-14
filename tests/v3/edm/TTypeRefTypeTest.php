<?php

namespace AlgoWeb\ODataMetadata\Tests\v3\edm;

use AlgoWeb\ODataMetadata\MetadataV3\edm\TTypeRefType;
use AlgoWeb\ODataMetadata\Tests\TestCase;

class TTypeRefTypeTest extends TestCase
{
    public function testSetDefaultValueNullString()
    {
        $foo = new TTypeRefType();
        $foo->setDefaultValue(null);
        $this->assertEquals(null, $foo->getDefaultValue());
    }

    public function testSetDefaultValueActualString()
    {
        $foo = new TTypeRefType();
        $foo->setDefaultValue("string");
        $this->assertEquals('string', $foo->getDefaultValue());
    }

    public function testSetDefaultValueEmptyArrayAsString()
    {
        $expected = "Default value must be a string";
        $actual = null;

        $foo = new TTypeRefType();
        try {
            $foo->setDefaultValue([]);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testSetDefaultValueNonEmptyArrayAsString()
    {
        $expected = "Default value must be a string";
        $actual = null;

        $foo = new TTypeRefType();
        try {
            $foo->setDefaultValue(['a']);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testSetDefaultValueObjectAsString()
    {
        $expected = "Default value must be a string";
        $actual = null;

        $foo = new TTypeRefType();
        try {
            $foo->setDefaultValue(new \DateTime());
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }
}
