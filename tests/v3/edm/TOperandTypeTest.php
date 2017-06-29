<?php

namespace AlgoWeb\ODataMetadata\Tests\v3\edm;

use AlgoWeb\ODataMetadata\MetadataV3\edm\TAnonymousFunctionExpressionType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TApplyExpressionType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TCollectionExpressionType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TEntitySetReferenceExpressionType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionReferenceExpressionType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TIfExpressionType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TOperandType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TParameterReferenceExpressionType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyReferenceExpressionType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TRecordExpressionType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TTypeAssertExpressionType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TTypeTestExpressionType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TValueTermReferenceExpressionType;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class TOperandTypeTest extends TestCase
{
    public function testSetStringNullString()
    {
        $foo = new TOperandType();
        $foo->setString(null);
        $this->assertEquals(null, $foo->getString());
    }

    public function testSetStringActualString()
    {
        $foo = new TOperandType();
        $foo->setString("string");
        $this->assertEquals('string', $foo->getString());
    }

    public function testSetStringEmptyArrayAsString()
    {
        $expected = "String must be a string";
        $actual = null;

        $foo = new TOperandType();
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

        $foo = new TOperandType();
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

        $foo = new TOperandType();
        try {
            $foo->setString(new \DateTime());
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testSetGetBinaryRoundTrip()
    {
        $expected = 'zyxvut';
        $foo = new TOperandType();
        $foo->setBinary("zyxvut");
        $this->assertEquals($expected, $foo->getBinary());
    }

    public function testSetGetIntRoundTrip()
    {
        $expected = 'zyxvut';
        $foo = new TOperandType();
        $foo->setInt("zyxvut");
        $this->assertEquals($expected, $foo->getInt());
    }

    public function testSetGetFloatRoundTrip()
    {
        $expected = 'zyxvut';
        $foo = new TOperandType();
        $foo->setFloat("zyxvut");
        $this->assertEquals($expected, $foo->getFloat());
    }

    public function testSetGetDecimalRoundTrip()
    {
        $expected = 'zyxvut';
        $foo = new TOperandType();
        $foo->setDecimal("zyxvut");
        $this->assertEquals($expected, $foo->getDecimal());
    }

    public function testSetGetBoolRoundTrip()
    {
        $foo = new TOperandType();
        $foo->setBool(null);
        $this->assertFalse($foo->getBool());
    }

    public function testSetGetDateTimeRoundTrip()
    {
        $expected = new \DateTime();
        $foo = new TOperandType();
        $foo->setDateTime($expected);
        $this->assertEquals($expected, $foo->getDateTime());
    }

    public function testSetGetDateTimeOffsetRoundTrip()
    {
        $expected = new \DateTime();
        $foo = new TOperandType();
        $foo->setDateTimeOffset($expected);
        $this->assertEquals($expected, $foo->getDateTimeOffset());
    }

    public function testSetBadIf()
    {
        $expected = "";
        $actual = null;

        $if = m::mock(TIfExpressionType::class);
        $if->shouldReceive('isOK')->andReturn(false);

        $foo = new TOperandType();

        try {
            $foo->setIf($if);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testSetGetIfRoundTrip()
    {
        $if = m::mock(TIfExpressionType::class);
        $if->shouldReceive('isOK')->andReturn(true);

        $foo = new TOperandType();
        $foo->setIf($if);
        $result = $foo->getIf();
        $this->assertTrue($result instanceof TIfExpressionType, get_class($result));
        $this->assertTrue($result->isOK());
    }

    public function testSetBadRecord()
    {
        $expected = "";
        $actual = null;

        $if = m::mock(TRecordExpressionType::class);
        $if->shouldReceive('isOK')->andReturn(false);

        $foo = new TOperandType();

        try {
            $foo->setRecord($if);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testSetGetRecordRoundTrip()
    {
        $if = m::mock(TRecordExpressionType::class);
        $if->shouldReceive('isOK')->andReturn(true);

        $foo = new TOperandType();
        $foo->setRecord($if);
        $result = $foo->getRecord();
        $this->assertTrue($result instanceof TRecordExpressionType, get_class($result));
        $this->assertTrue($result->isOK());
    }

    public function testSetBadCollection()
    {
        $expected = "";
        $actual = null;

        $if = m::mock(TCollectionExpressionType::class);
        $if->shouldReceive('isOK')->andReturn(false);

        $foo = new TOperandType();

        try {
            $foo->setCollection($if);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testSetGetCollectionRoundTrip()
    {
        $if = m::mock(TCollectionExpressionType::class);
        $if->shouldReceive('isOK')->andReturn(true);

        $foo = new TOperandType();
        $foo->setCollection($if);
        $result = $foo->getCollection();
        $this->assertTrue($result instanceof TCollectionExpressionType, get_class($result));
        $this->assertTrue($result->isOK());
    }

    public function testSetBadTypeAssert()
    {
        $expected = "";
        $actual = null;

        $if = m::mock(TTypeAssertExpressionType::class);
        $if->shouldReceive('isOK')->andReturn(false);

        $foo = new TOperandType();

        try {
            $foo->setTypeAssert($if);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testSetGetTypeAssertRoundTrip()
    {
        $if = m::mock(TTypeAssertExpressionType::class);
        $if->shouldReceive('isOK')->andReturn(true);

        $foo = new TOperandType();
        $foo->setTypeAssert($if);
        $result = $foo->getTypeAssert();
        $this->assertTrue($result instanceof TTypeAssertExpressionType, get_class($result));
        $this->assertTrue($result->isOK());
    }

    public function testSetBadTypeTest()
    {
        $expected = "";
        $actual = null;

        $if = m::mock(TTypeTestExpressionType::class);
        $if->shouldReceive('isOK')->andReturn(false);

        $foo = new TOperandType();

        try {
            $foo->setTypeTest($if);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testSetGetTypeTestRoundTrip()
    {
        $if = m::mock(TTypeTestExpressionType::class);
        $if->shouldReceive('isOK')->andReturn(true);

        $foo = new TOperandType();
        $foo->setTypeTest($if);
        $result = $foo->getTypeTest();
        $this->assertTrue($result instanceof TTypeTestExpressionType, get_class($result));
        $this->assertTrue($result->isOK());
    }

    public function testSetBadFunctionReference()
    {
        $expected = "";
        $actual = null;

        $if = m::mock(TFunctionReferenceExpressionType::class);
        $if->shouldReceive('isOK')->andReturn(false);

        $foo = new TOperandType();

        try {
            $foo->setFunctionReference($if);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testSetGetFunctionReferenceRoundTrip()
    {
        $if = m::mock(TFunctionReferenceExpressionType::class);
        $if->shouldReceive('isOK')->andReturn(true);

        $foo = new TOperandType();
        $foo->setFunctionReference($if);
        $result = $foo->getFunctionReference();
        $this->assertTrue($result instanceof TFunctionReferenceExpressionType, get_class($result));
        $this->assertTrue($result->isOK());
    }

    public function testSetBadEntitySetReference()
    {
        $expected = "";
        $actual = null;

        $if = m::mock(TEntitySetReferenceExpressionType::class);
        $if->shouldReceive('isOK')->andReturn(false);

        $foo = new TOperandType();

        try {
            $foo->setEntitySetReference($if);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testSetGetEntitySetReferenceRoundTrip()
    {
        $if = m::mock(TEntitySetReferenceExpressionType::class);
        $if->shouldReceive('isOK')->andReturn(true);

        $foo = new TOperandType();
        $foo->setEntitySetReference($if);
        $result = $foo->getEntitySetReference();
        $this->assertTrue($result instanceof TEntitySetReferenceExpressionType, get_class($result));
        $this->assertTrue($result->isOK());
    }

    public function testSetBadAnonymousFunction()
    {
        $expected = "";
        $actual = null;

        $if = m::mock(TAnonymousFunctionExpressionType::class);
        $if->shouldReceive('isOK')->andReturn(false);

        $foo = new TOperandType();

        try {
            $foo->setAnonymousFunction($if);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testSetGetAnonymousFunctionRoundTrip()
    {
        $if = m::mock(TAnonymousFunctionExpressionType::class);
        $if->shouldReceive('isOK')->andReturn(true);

        $foo = new TOperandType();
        $foo->setAnonymousFunction($if);
        $result = $foo->getAnonymousFunction();
        $this->assertTrue($result instanceof TAnonymousFunctionExpressionType, get_class($result));
        $this->assertTrue($result->isOK());
    }

    public function testSetBadParameterReference()
    {
        $expected = "";
        $actual = null;

        $if = m::mock(TParameterReferenceExpressionType::class);
        $if->shouldReceive('isOK')->andReturn(false);

        $foo = new TOperandType();

        try {
            $foo->setParameterReference($if);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testSetGetParameterReferenceRoundTrip()
    {
        $if = m::mock(TParameterReferenceExpressionType::class);
        $if->shouldReceive('isOK')->andReturn(true);

        $foo = new TOperandType();
        $foo->setParameterReference($if);
        $result = $foo->getParameterReference();
        $this->assertTrue($result instanceof TParameterReferenceExpressionType, get_class($result));
        $this->assertTrue($result->isOK());
    }

    public function testSetBadApply()
    {
        $expected = "";
        $actual = null;

        $if = m::mock(TApplyExpressionType::class);
        $if->shouldReceive('isOK')->andReturn(false);

        $foo = new TOperandType();

        try {
            $foo->setApply($if);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testSetGetApplyRoundTrip()
    {
        $if = m::mock(TApplyExpressionType::class);
        $if->shouldReceive('isOK')->andReturn(true);

        $foo = new TOperandType();
        $foo->setApply($if);
        $result = $foo->getApply();
        $this->assertTrue($result instanceof TApplyExpressionType, get_class($result));
        $this->assertTrue($result->isOK());
    }

    public function testSetBadPropertyReference()
    {
        $expected = "";
        $actual = null;

        $if = m::mock(TPropertyReferenceExpressionType::class);
        $if->shouldReceive('isOK')->andReturn(false);

        $foo = new TOperandType();

        try {
            $foo->setPropertyReference($if);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testSetGetPropertyReferenceRoundTrip()
    {
        $if = m::mock(TPropertyReferenceExpressionType::class);
        $if->shouldReceive('isOK')->andReturn(true);

        $foo = new TOperandType();
        $foo->setPropertyReference($if);
        $result = $foo->getPropertyReference();
        $this->assertTrue($result instanceof TPropertyReferenceExpressionType, get_class($result));
        $this->assertTrue($result->isOK());
    }

    public function testSetBadValueTermReference()
    {
        $expected = "";
        $actual = null;

        $if = m::mock(TValueTermReferenceExpressionType::class);
        $if->shouldReceive('isOK')->andReturn(false);

        $foo = new TOperandType();

        try {
            $foo->setValueTermReference($if);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testSetGetValueTermReferenceRoundTrip()
    {
        $if = m::mock(TValueTermReferenceExpressionType::class);
        $if->shouldReceive('isOK')->andReturn(true);

        $foo = new TOperandType();
        $foo->setValueTermReference($if);
        $result = $foo->getValueTermReference();
        $this->assertTrue($result instanceof TValueTermReferenceExpressionType, get_class($result));
        $this->assertTrue($result->isOK());
    }

    public function testGExpressionNotValidWhenMoreThanOneBasicExpressionSet()
    {
        $expected = '2 fields not null.  Need maximum of 1: AlgoWeb\ODataMetadata\MetadataV3\edm\TOperandType';
        $actual = null;

        $if = m::mock(TValueTermReferenceExpressionType::class);
        $if->shouldReceive('isOK')->andReturn(true);

        $apply = m::mock(TApplyExpressionType::class);
        $apply->shouldReceive('isOK')->andReturn(true);

        $foo = new TOperandType();
        $foo->setValueTermReference($if);
        $foo->setApply($apply);

        $this->assertFalse($foo->isGExpressionValid($actual));
        $this->assertEquals($expected, $actual);
    }

    public function testSetBadEnum()
    {
        $expected = "Enum must be a valid TQualifiedName";
        $actual = null;

        $foo = new TOperandType();
        try {
            $foo->setEnum(' _ ');
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testSetGetEnumRoundTrip()
    {
        $expected = "Org.OData.Publication.V1.DocumentationUrl";

        $foo = new TOperandType();
        $foo->setEnum($expected);
        $actual = $foo->getEnum();

        $this->assertEquals($expected, $actual);
    }

    public function testSetBadPath()
    {
        $expected = "Path must be a valid TQualifiedName";
        $actual = null;

        $foo = new TOperandType();
        try {
            $foo->setPath(' _ ');
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testSetGetPathRoundTrip()
    {
        $expected = "Org.OData.Publication.V1.DocumentationUrl";

        $foo = new TOperandType();
        $foo->setPath($expected);
        $actual = $foo->getPath();

        $this->assertEquals($expected, $actual);
    }

    public function testSetBadGuid()
    {
        $expected = "Guid must be a valid TGuidLiteral";
        $actual = null;

        $foo = new TOperandType();
        try {
            $foo->setGuid(' _ ');
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testSetGetGuidRoundTrip()
    {
        $expected = "00000000-0000-0000-0000-000000000000";
        $actual = null;

        $foo = new TOperandType();
        $foo->setGuid($expected);
        $actual = $foo->getGuid();
        $this->assertEquals($expected, $actual);
    }
}
