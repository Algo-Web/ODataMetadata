<?php

namespace AlgoWeb\ODataMetadata\Tests\v3\edm;

use AlgoWeb\ODataMetadata\MetadataV3\edm\TTypeAnnotationType;
use AlgoWeb\ODataMetadata\Tests\TestCase;

class TTypeAnnotationTypeTest extends TestCase
{
    public function testSetStringNullString()
    {
        $foo = new TTypeAnnotationType();
        $foo->setString(null);
        $this->assertEquals(null, $foo->getString());
    }

    public function testSetStringActualString()
    {
        $foo = new TTypeAnnotationType();
        $foo->setString("string");
        $this->assertEquals('string', $foo->getString());
    }

    public function testSetStringEmptyArrayAsString()
    {
        $expected = "String must be a string";
        $actual = null;

        $foo = new TTypeAnnotationType();
        try {
            $foo->setString([]);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testSetStringNonEmptyArrayAsString()
    {
        $expected = "String must be a string";
        $actual = null;

        $foo = new TTypeAnnotationType();
        try {
            $foo->setString(['a']);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testSetStringObjectAsString()
    {
        $expected = "String must be a string";
        $actual = null;

        $foo = new TTypeAnnotationType();
        try {
            $foo->setString(new \DateTime());
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }
}
