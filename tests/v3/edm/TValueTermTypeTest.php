<?php

namespace AlgoWeb\ODataMetadata\Tests\v3\edm;

use AlgoWeb\ODataMetadata\MetadataV3\edm\TValueTermType;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class TValueTermTypeTest extends TestCase
{
    public function testSetGetNullableRoundTrip()
    {
        $foo = new TValueTermType();
        $foo->setNullable(true);
        $this->assertTrue($foo->getNullable());
    }

    public function testSetGetNullableRoundTripNotBool()
    {
        $foo = new TValueTermType();
        $foo->setNullable('nullable');
        $this->assertTrue($foo->getNullable());
    }

    public function testSetBadMaxLength()
    {
        $expected = 'Input must be numeric';
        $actual = null;

        $foo = new TValueTermType();

        try {
            $foo->setMaxLength(" _ ");
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testSetGetMaxLengthRoundTrip()
    {
        $expected = "11";
        $actual = null;

        $foo = new TValueTermType();
        $foo->setMaxLength($expected);
        $actual = $foo->getMaxLength();

        $this->assertEquals($expected, $actual);
    }

    public function testSetNullMaxLength()
    {
        $foo = new TValueTermType();
        $foo->setMaxLength(null);
        $this->assertNull($foo->getMaxLength());
    }

    public function testSetBadFixedLength()
    {
        $expected = 'Fixed length must be a valid TFixedLengthFacet';
        $actual = null;

        $foo = new TValueTermType();

        try {
            $foo->setFixedLength(" _ ");
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testSetGetFixedLengthRoundTrip()
    {
        $expected = true;
        $actual = null;

        $foo = new TValueTermType();
        $foo->setFixedLength($expected);
        $actual = $foo->getFixedLength();

        $this->assertEquals($expected, $actual);
    }

    public function testSetBadPrecision()
    {
        $expected = 'Input must be numeric';
        $actual = null;

        $foo = new TValueTermType();

        try {
            $foo->setPrecision(" _ ");
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testSetGetPrecisionRoundTrip()
    {
        $expected = "11";
        $actual = null;

        $foo = new TValueTermType();
        $foo->setPrecision($expected);
        $actual = $foo->getPrecision();

        $this->assertEquals($expected, $actual);
    }

    public function testSetNullPrecision()
    {
        $foo = new TValueTermType();
        $foo->setPrecision(null);
        $this->assertNull($foo->getPrecision());
    }

    public function testSetBadScale()
    {
        $expected = 'Input must be numeric';
        $actual = null;

        $foo = new TValueTermType();

        try {
            $foo->setScale(" _ ");
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testSetGetScaleRoundTrip()
    {
        $expected = "11";
        $actual = null;

        $foo = new TValueTermType();
        $foo->setScale($expected);
        $actual = $foo->getScale();

        $this->assertEquals($expected, $actual);
    }

    public function testSetNullScale()
    {
        $foo = new TValueTermType();
        $foo->setScale(null);
        $this->assertNull($foo->getScale());
    }

    public function testSetBadUnicode()
    {
        $expected = 'Unicode must be a valid TUnicodeFacet';
        $actual = null;

        $foo = new TValueTermType();

        try {
            $foo->setUnicode(" _ ");
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testSetGetUnicodeRoundTrip()
    {
        $expected = true;
        $actual = null;

        $foo = new TValueTermType();
        $foo->setUnicode($expected);
        $actual = $foo->getUnicode();

        $this->assertEquals($expected, $actual);
    }

    public function testSetBadCollation()
    {
        $expected = "Collation must be a valid TCollationFacet";
        $actual = null;

        $foo = new TValueTermType();

        try {
            $foo->setCollation(new \DateTime());
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testSetGetCollationRoundTrip()
    {
        $expected = "swedish";
        $actual = null;

        $foo = new TValueTermType();
        $foo->setCollation($expected);
        $actual = $foo->getCollation();

        $this->assertEquals($expected, $actual);
    }

    public function testSetBadSRID()
    {
        $expected = 'Input must be numeric';
        $actual = null;

        $foo = new TValueTermType();

        try {
            $foo->setSRID(" _ ");
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testSetGetSRIDRoundTrip()
    {
        $expected = "11";
        $actual = null;

        $foo = new TValueTermType();
        $foo->setSRID($expected);
        $actual = $foo->getSRID();

        $this->assertEquals($expected, $actual);
    }

    public function testSetNullSRID()
    {
        $expected = 'Input must be a string';
        $actual = null;

        $foo = new TValueTermType();
        try {
            $foo->setSRID(null);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testIsTFacetAttributeValidNewCreation()
    {
        $expected = 'Nullable must be boolean: AlgoWeb\ODataMetadata\MetadataV3\edm\TValueTermType';
        $actual = null;

        $foo = new TValueTermType();
        $this->assertFalse($foo->isTFacetAttributesTraitValid($actual));
        $this->assertEquals($expected, $actual);
    }

    public function testIsTFacetAttributeValidNullableSet()
    {
        $expected = '';
        $actual = null;

        $foo = new TValueTermType();
        $foo->setNullable(true);
        $this->assertTrue($foo->isTFacetAttributesTraitValid($actual));
        $this->assertEquals($expected, $actual);
    }

    public function testIsTFacetAttributeValidBadCollation()
    {
        $expected = "Collation must be a valid TCollationFacet:";
        $actual = null;

        $foo = m::mock(TValueTermType::class)->makePartial();
        $foo->setNullable(true);
        $foo->shouldReceive('isTCollationFacetValid')->andReturn(true, false)->twice();

        $foo->setCollation(' _ ');
        $this->assertFalse($foo->isTFacetAttributesTraitValid($actual));
        $this->assertStringStartsWith($expected, $actual);
    }

    public function testIsTFacetAttributeValidBadMaxLength()
    {
        $expected = "Max length must be a valid TMaxLengthFacet: ";
        $actual = null;

        $foo = m::mock(TValueTermType::class)->makePartial();
        $foo->setNullable(true);
        $foo->shouldReceive('isTMaxLengthFacetValid')->andReturn(true, false)->twice();

        $foo->setMaxLength(' _ ');
        $this->assertFalse($foo->isTFacetAttributesTraitValid($actual));
        $this->assertStringStartsWith($expected, $actual);
    }

    public function testIsTFacetAttributeValidBadFixedLength()
    {
        $expected = "Fixed length must be a valid TFixedLengthFacet: ";
        $actual = null;

        $foo = m::mock(TValueTermType::class)->makePartial();
        $foo->setNullable(true);
        $foo->shouldReceive('isTIsFixedLengthFacetTraitValid')->andReturn(true, false)->twice();

        $foo->setFixedLength(' _ ');
        $this->assertFalse($foo->isTFacetAttributesTraitValid($actual));
        $this->assertStringStartsWith($expected, $actual);
    }

    public function testIsTFacetAttributeValidBadPrecision()
    {
        $expected = "Precision must be a valid TPrecisionFacet: ";
        $actual = null;

        $foo = m::mock(TValueTermType::class)->makePartial();
        $foo->setNullable(true);
        $foo->shouldReceive('isTPrecisionFacetValid')->andReturn(true, false)->twice();

        $foo->setPrecision(' _ ');
        $this->assertFalse($foo->isTFacetAttributesTraitValid($actual));
        $this->assertStringStartsWith($expected, $actual);
    }

    public function testIsTFacetAttributeValidBadScale()
    {
        $expected = "Scale must be a valid TScaleFacet: ";
        $actual = null;

        $foo = m::mock(TValueTermType::class)->makePartial();
        $foo->setNullable(true);
        $foo->shouldReceive('isTScaleFacetValid')->andReturn(true, false)->twice();

        $foo->setScale(' _ ');
        $this->assertFalse($foo->isTFacetAttributesTraitValid($actual));
        $this->assertStringStartsWith($expected, $actual);
    }

    public function testIsTFacetAttributeValidBadSRID()
    {
        $expected = "SRID must be a valid TSridFacet: ";
        $actual = null;

        $foo = m::mock(TValueTermType::class)->makePartial();
        $foo->setNullable(true);
        $foo->shouldReceive('isTSridFacetValid')->andReturn(true, false)->twice();

        $foo->setSRID(' _ ');
        $this->assertFalse($foo->isTFacetAttributesTraitValid($actual));
        $this->assertStringStartsWith($expected, $actual);
    }

    public function testIsTFacetAttributeValidBadUnicode()
    {
        $expected = "Unicode must be a valid TUnicodeFacet: ";
        $actual = null;

        $foo = m::mock(TValueTermType::class)->makePartial();
        $foo->setNullable(true);
        $foo->shouldReceive('isTIsUnicodeFacetTraitValid')->andReturn(true, false)->twice();

        $foo->setUnicode(' _ ');
        $this->assertFalse($foo->isTFacetAttributesTraitValid($actual));
        $this->assertStringStartsWith($expected, $actual);
    }
}
