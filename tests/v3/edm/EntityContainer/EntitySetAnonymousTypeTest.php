<?php

namespace AlgoWeb\ODataMetadata\Tests\v3\edm\EntityContainer;

use AlgoWeb\ODataMetadata\MetadataV3\edm\EntityContainer\EntitySetAnonymousType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TDocumentationType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TTypeAnnotationType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TValueAnnotationType;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class EntitySetAnonymousTypeTest extends TestCase
{
    public function testSetBadName()
    {
        $expected = "Name must be a valid TSimpleIdentifier";
        $actual = null;

        $foo = new EntitySetAnonymousType();
        $name = " _ ";

        try {
            $foo->setName($name);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testSetBadEntityType()
    {
        $expected = "Entity type must be a valid TQualifiedName";
        $actual = null;

        $foo = new EntitySetAnonymousType();
        $name = " _ ";

        try {
            $foo->setEntityType($name);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testSetBadGetterAccess()
    {
        $expected = "Getter access must be a valid TAccess";
        $actual = null;

        $foo = new EntitySetAnonymousType();
        $name = " _ ";

        try {
            $foo->setGetterAccess($name);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testIsTEntitySetAttributesOKBadName()
    {
        $expectedStarts = "Name must be a valid TSimpleIdentifier";
        $expectedEnds = "AlgoWeb_ODataMetadata_MetadataV3_edm_EntityContainer_EntitySetAnonymousType";
        $actual = null;

        $foo = m::mock(EntitySetAnonymousType::class)->makePartial();
        $foo->shouldReceive('isTSimpleIdentifierValid')->andReturn(true, false)->twice();
        
        $foo->setName(" _ ");
        
        $this->assertFalse($foo->isTEntitySetAttributesOK($actual));
        $this->assertStringStartsWith($expectedStarts, $actual);
        $this->assertStringEndsWith($expectedEnds, $actual);
    }

    public function testIsTEntitySetAttributesOKBadEntityType()
    {
        $expectedStarts = "Entity type must be a valid TQualifiedName";
        $expectedEnds = "AlgoWeb_ODataMetadata_MetadataV3_edm_EntityContainer_EntitySetAnonymousType";
        $actual = null;

        $foo = m::mock(EntitySetAnonymousType::class)->makePartial();
        $foo->shouldReceive('isTQualifiedNameValid')->andReturn(true, false)->twice();

        $foo->setEntityType(" _ ");

        $this->assertFalse($foo->isTEntitySetAttributesOK($actual));
        $this->assertStringStartsWith($expectedStarts, $actual);
        $this->assertStringEndsWith($expectedEnds, $actual);
    }

    public function testIsTEntitySetAttributesOKBadGetterAccess()
    {
        $expectedStarts = "Getter access must be a valid TAccess";
        $expectedEnds = "AlgoWeb_ODataMetadata_MetadataV3_edm_EntityContainer_EntitySetAnonymousType";
        $actual = null;

        $foo = m::mock(EntitySetAnonymousType::class)->makePartial();
        $foo->shouldReceive('isTAccessOk')->andReturn(true, false)->twice();

        $foo->setGetterAccess(" _ ");

        $this->assertFalse($foo->isTEntitySetAttributesOK($actual));
        $this->assertStringStartsWith($expectedStarts, $actual);
        $this->assertStringEndsWith($expectedEnds, $actual);
    }

    public function testSetBadTypeAnnotation()
    {
        $expected = "";
        $actual = null;

        $type = m::mock(TTypeAnnotationType::class)->makePartial();
        $type->shouldReceive('isOK')->andReturn(false);

        $foo = new EntitySetAnonymousType();

        try {
            $foo->setTypeAnnotation([$type]);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testAddBadTypeAnnotation()
    {
        $expected = '';
        $actual = null;

        $type = m::mock(TTypeAnnotationType::class)->makePartial();
        $type->shouldReceive('isOK')->andReturn(false);

        $foo = new EntitySetAnonymousType();

        try {
            $foo->addToTypeAnnotation($type);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testAddGoodTypeAnnotation()
    {
        $type = m::mock(TTypeAnnotationType::class)->makePartial();
        $type->shouldReceive('isOK')->andReturn(true);

        $foo = new EntitySetAnonymousType();

        $foo->addToTypeAnnotation($type);
        $this->assertTrue($foo->issetTypeAnnotation(0));
        $foo->unsetTypeAnnotation(0);
        $this->assertFalse($foo->issetTypeAnnotation(0));
    }

    public function testAddBadDocumentation()
    {
        $expected = '';
        $actual = null;

        $doc = m::mock(TDocumentationType::class);
        $doc->shouldReceive('isOK')->andReturn(false);

        $foo = new EntitySetAnonymousType();

        try {
            $foo->addToDocumentation($doc);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testAddGoodDocumentation()
    {
        $doc = m::mock(TDocumentationType::class);
        $doc->shouldReceive('isOK')->andReturn(true);

        $foo = new EntitySetAnonymousType();

        $foo->addToDocumentation($doc);
        $this->assertTrue($foo->issetDocumentation(0));
        $foo->unsetDocumentation(0);
        $this->assertFalse($foo->issetDocumentation(0));
    }

    public function testSetBadDocumentation()
    {
        $expected = '';
        $actual = null;

        $doc = m::mock(TDocumentationType::class);
        $doc->shouldReceive('isOK')->andReturn(false);

        $foo = new EntitySetAnonymousType();

        try {
            $foo->setDocumentation([$doc]);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testSetBadValueAnnotation()
    {
        $expected = "";
        $actual = null;

        $type = m::mock(TValueAnnotationType::class)->makePartial();
        $type->shouldReceive('isOK')->andReturn(false);

        $foo = new EntitySetAnonymousType();

        try {
            $foo->setValueAnnotation([$type]);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testAddBadValueAnnotation()
    {
        $expected = '';
        $actual = null;

        $type = m::mock(TValueAnnotationType::class)->makePartial();
        $type->shouldReceive('isOK')->andReturn(false);

        $foo = new EntitySetAnonymousType();

        try {
            $foo->addToValueAnnotation($type);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testAddGoodValueAnnotation()
    {
        $type = m::mock(TValueAnnotationType::class)->makePartial();
        $type->shouldReceive('isOK')->andReturn(true);

        $foo = new EntitySetAnonymousType();

        $foo->addToValueAnnotation($type);
        $this->assertTrue($foo->issetValueAnnotation(0));
        $foo->unsetValueAnnotation(0);
        $this->assertFalse($foo->issetValueAnnotation(0));
    }

    public function testIsOkTooManyDocumentation()
    {
        $expected = 'Supplied array not a valid array: '
                    .'AlgoWeb\ODataMetadata\MetadataV3\edm\EntityContainer\EntitySetAnonymousType';
        $actual = null;

        $doc = m::mock(TDocumentationType::class);
        $doc->shouldReceive('isOK')->andReturn(true);

        $foo = new EntitySetAnonymousType();
        $foo->addToDocumentation($doc);
        $foo->addToDocumentation($doc);

        $this->assertFalse($foo->isOK($actual));
        $this->assertEquals($expected, $actual);
    }

    public function testIsOKBadTypeAnnotations()
    {
        $expected = '';
        $actual = null;

        $type = m::mock(TTypeAnnotationType::class)->makePartial();
        $type->shouldReceive('isOK')->andReturn(true, false)->twice();

        $foo = new EntitySetAnonymousType();
        $foo->addToTypeAnnotation($type);

        $this->assertFalse($foo->isOK($actual));
        $this->assertEquals($expected, $actual);
    }

    public function testIsOKBadValueAnnotations()
    {
        $expected = '';
        $actual = null;

        $type = m::mock(TValueAnnotationType::class)->makePartial();
        $type->shouldReceive('isOK')->andReturn(true, false)->twice();

        $foo = new EntitySetAnonymousType();
        $foo->addToValueAnnotation($type);

        $this->assertFalse($foo->isOK($actual));
        $this->assertEquals($expected, $actual);
    }
}
