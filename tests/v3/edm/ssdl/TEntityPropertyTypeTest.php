<?php

namespace AlgoWeb\ODataMetadata\Tests\v3\edm\ssdl;

use AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TEntityPropertyType;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class TEntityPropertyTypeTest extends TestCase
{
    public function testSetNullDefaultValue()
    {
        $foo = new TEntityPropertyType();
        $foo->setDefaultValue(null);
        $this->assertEquals(null, $foo->getDefaultValue());
    }

    public function testSetStringDefaultValue()
    {
        $foo = new TEntityPropertyType();
        $foo->setDefaultValue('abc');
        $this->assertEquals('abc', $foo->getDefaultValue());
    }

    public function testSetNumericDefaultValue()
    {
        $foo = new TEntityPropertyType();
        $foo->setDefaultValue(1234);
        $this->assertEquals('1234', $foo->getDefaultValue());
    }

    public function testSetObjectDefaultValue()
    {
        $expected = "Default value cannot be empty";
        $actual = null;

        $foo = new TEntityPropertyType();
        try {
            $foo->setDefaultValue(new \DateTime());
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testSetEmptyArrayDefaultValue()
    {
        $expected = "Default value cannot be empty";
        $actual = null;

        $foo = new TEntityPropertyType();
        try {
            $foo->setDefaultValue([]);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testSetNonEmptyArrayDefaultValue()
    {
        $expected = "Default value cannot be empty";
        $actual = null;

        $foo = new TEntityPropertyType();
        try {
            $foo->setDefaultValue(['a']);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }
}
