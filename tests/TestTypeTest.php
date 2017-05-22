<?php

namespace AlgoWeb\ODataMetadata\Tests;

use \Mockery as m;

class TestTypeTest extends TestCase
{
    public function testIsStringNotNullOrEmptyWithNull()
    {
        $string = null;
        $foo = new testType();
        $this->assertFalse($foo->isStringNotNullOrEmpty($string));
    }

    public function testIsStringNotNullOrEmptyWithEmpty()
    {
        $string = '';
        $foo = new testType();
        $this->assertFalse($foo->isStringNotNullOrEmpty($string));
    }

    public function testIsStringNotNullOrEmptyWithNonString()
    {
        $string = new \stdClass();
        $foo = new testType();
        $this->assertFalse($foo->isStringNotNullOrEmpty($string));
    }

    public function testIsStringNotNullOrEmptyWithObject()
    {
        $string = new \stdClass();
        $foo = new testType();
        $this->assertFalse($foo->isStringNotNullOrEmpty($string));
    }

    public function testIsStringNotNullOrEmptyWithNumber()
    {
        $string = 2134;
        $foo = new testType();
        $this->assertFalse($foo->isStringNotNullOrEmpty($string));
    }

    public function testIsStringNotNullOrEmptyWithString()
    {
        $string = 'An actual string';
        $foo = new testType();
        $this->assertTrue($foo->isStringNotNullOrEmpty($string));
    }

    public function testIsStringNotNullOrEmptyWithNumberAsString()
    {
        $string = '1234';
        $foo = new testType();
        $this->assertTrue($foo->isStringNotNullOrEmpty($string));
    }

    public function testIsNotNullInstanceOfWhenPassedObjectToCheck()
    {
        $var = new \stdClass();
        $instanceof = new \stdClass();

        $foo = new testType();
        $this->assertTrue($foo->isNotNullInstanceOf($var, $instanceof));
    }

    public function testIsNotNullInstanceOfWhenPassedStringToCheck()
    {
        $var = new \stdClass();
        $instanceof = get_class($var);

        $foo = new testType();
        $this->assertTrue($foo->isNotNullInstanceOf($var, $instanceof));
    }

    public function testIsNotNullInstanceOfWhenPassedNonObjectToCheck()
    {
        $var = 'Another string.  How amazing.';
        $instanceof = new \stdClass();

        $foo = new testType();
        $this->assertFalse($foo->isNotNullInstanceOf($var, $instanceof));
    }

    public function testIsNotNullInstanceOfWhenPassedNullToCheck()
    {
        $var = null;
        $instanceof = new \stdClass();

        $foo = new testType();
        $this->assertFalse($foo->isNotNullInstanceOf($var, $instanceof));
    }

    public function testIsNullInstanceOfWhenPassedObjectToCheck()
    {
        $var = new \stdClass();
        $instanceof = new \stdClass();

        $foo = new testType();
        $this->assertFalse($foo->isNullInstanceOf($var, $instanceof));
    }

    public function testIsNullInstanceOfWhenPassedStringToCheck()
    {
        $var = new \stdClass();
        $instanceof = get_class($var);

        $foo = new testType();
        $this->assertFalse($foo->isNullInstanceOf($var, $instanceof));
    }

    public function testIsNullInstanceOfWhenPassedNonObjectToCheck()
    {
        $var = 'Another string.  How amazing.';
        $instanceof = new \stdClass();

        $foo = new testType();
        $this->assertFalse($foo->isNullInstanceOf($var, $instanceof));
    }

    public function testIsNullInstanceOfWhenPassedNullToCheck()
    {
        $var = null;
        $instanceof = new \stdClass();

        $foo = new testType();
        $this->assertTrue($foo->isNullInstanceOf($var, $instanceof));
    }

    public function testIsValidArrayNotEnoughBitz()
    {
        $arr = [];
        $instanceof = get_class(new \stdClass());

        $foo = new testType();
        $this->assertFalse($foo->isValidArray($arr, $instanceof, 1, -1));
    }

    public function testIsValidArrayTooManyBitz()
    {
        $arr = ['abc'];
        $instanceof = get_class(new \stdClass());

        $foo = new testType();
        $this->assertFalse($foo->isValidArray($arr, $instanceof, 0, 0));
    }

    public function testIsValidArrayWrongType()
    {
        $arr = ['abc'];
        $instanceof = get_class(new \stdClass());

        $foo = new testType();
        $this->assertFalse($foo->isValidArray($arr, $instanceof));
    }

    public function testIsValidArrayRightType()
    {
        $arr = [new \stdClass()];
        $instanceof = get_class(new \stdClass());

        $foo = new testType();
        $this->assertTrue($foo->isValidArray($arr, $instanceof));
    }

    public function testIsChildArrayOkForEmptyArray()
    {
        $msg = null;
        $arr = [];

        $foo = new testType();
        $this->assertTrue($foo->isChildArrayOK($arr, $msg), $msg);
    }

    public function testIsChildArrayOkForNonEmptyArrayWithBadGubbins()
    {
        $msg = null;
        $expected = "Child item is not an instance of IsOK: AlgoWeb\\ODataMetadata\\Tests\\testType";
        $arr = ['abc'];

        $foo = new testType();
        $this->assertFalse($foo->isChildArrayOK($arr, $msg), $msg);
        $this->assertEquals($expected, $msg);
    }

    public function testIsChildArrayOkForNonEmptyArrayWithGoodGubbinsNotOk()
    {
        $bar = m::mock(testType::class);
        // closure needs to return true to match the matcher and thus trip the andReturn(false) bit
        $bar->shouldReceive('isOK')->with(m::on(function (&$msg) {
            $msg = 'OH NOES!';
            return true;
        }))->andReturn(false);

        $msg = null;
        $expected = "OH NOES!";
        $arr = [ $bar ];

        $foo = new testType();
        $this->assertFalse($foo->isChildArrayOK($arr, $msg), $msg);
        $this->assertEquals($expected, $msg);
    }

    public function testIsUrlValidWithNull()
    {
        $url = null;

        $foo = new testType();
        $this->assertFalse($foo->isURLValid($url));
    }

    public function testIsUrlValidWithNonUrlString()
    {
        $url = 'abc';

        $foo = new testType();
        $this->assertFalse($foo->isURLValid($url));
    }

    public function testIsUrlValidWithUrlString()
    {
        $url = 'https://google.com';

        $foo = new testType();
        $this->assertTrue($foo->isURLValid($url));
    }

    public function testIsUrlValidWithUrlStringWithWWW()
    {
        $url = 'http://www.google.com';

        $foo = new testType();
        $this->assertTrue($foo->isURLValid($url));
    }

    public function testObjectNullOrOkWithNullObject()
    {
        $msg = null;
        $obj = null;
        $foo = new testType();
        $this->assertTrue($foo->isObjectNullOrOk($obj, $msg));
    }

    public function testObjectNullOrOkWithIsOkObjectActuallyOk()
    {
        $msg = null;
        $obj = m::mock(testType::class);
        // closure needs to return true to match the matcher and thus trip the andReturn(false) bit
        $obj->shouldReceive('isOK')->with(m::on(function (&$msg) {
            $msg = null;
            return true;
        }))->andReturn(true);
        $foo = new testType();
        $this->assertTrue($foo->isObjectNullOrOk($obj, $msg));
    }

    public function testObjectNullOrOkWithIsOkObjectNotOk()
    {
        $msg = null;
        $obj = m::mock(testType::class);
        // closure needs to return true to match the matcher and thus trip the andReturn(false) bit
        $obj->shouldReceive('isOK')->with(m::on(function (&$msg) {
            $msg = 'OH NOES!';
            return true;
        }))->andReturn(false);
        $expected = 'OH NOES!';
        $foo = new testType();
        $this->assertFalse($foo->isObjectNullOrOk($obj, $msg));
        $this->assertEquals($expected, $msg);
    }

    public function testIsValidArrayOkWhenNotValidArray()
    {
        $foo = m::mock(testType::class)->makePartial();
        $foo->shouldReceive('isValidArray')->withAnyArgs()->andReturn(false);

        $expected = "Supplied array not a valid array: Mockery";
        $msg = null;
        $this->assertFalse($foo->isValidArrayOk([], '', $msg));
        $msg = substr($msg, 0, strlen($expected));
        $this->assertEquals($expected, $msg);
    }

    public function testIsValidArrayOkWhenChildArrayNotOK()
    {
        $foo = m::mock(testType::class)->makePartial();
        $foo->shouldReceive('isValidArray')->withAnyArgs()->andReturn(true);
        $foo->shouldReceive('isChildArrayOK')->with(m::any(), m::on(function (&$msg) {
            $msg = 'OH NOES!';
            return true;
        }))->andReturn(false);
        $expected = 'OH NOES!';
        $msg = null;
        $this->assertFalse($foo->isValidArrayOK([], '', $msg));
        $this->assertEquals($expected, $msg);
    }

    public function testIsValidArrayOkWhenChildArrayIsOk()
    {
        $foo = m::mock(testType::class)->makePartial();
        $foo->shouldReceive('isValidArray')->withAnyArgs()->andReturn(true);
        $foo->shouldReceive('isChildArrayOK')->with(m::any(), m::on(function (&$msg) {
            $msg = null;
            return true;
        }))->andReturn(true);
        $expected = null;
        $msg = null;
        $this->assertTrue($foo->isValidArrayOK([], '', $msg));
        $this->assertEquals($expected, $msg);
    }

    public function testReplaceStringStartingWithSpaces()
    {
        $string = "This is a string";
        $expected = "This is a string";
        $foo = new testType();
        $result = $foo->replaceString($string);
        $this->assertEquals($expected, $result);
    }

    public function testReplaceStringStartingWithTabs()
    {
        $string = "This\tis\ta\tstring";
        $expected = "This is a string";
        $foo = new testType();
        $result = $foo->replaceString($string);
        $this->assertEquals($expected, $result);
    }

    public function testReplaceStringStartingWithNuLines()
    {
        $string = "This\nis\na\nstring";
        $expected = "This is a string";
        $foo = new testType();
        $result = $foo->replaceString($string);
        $this->assertEquals($expected, $result);
    }

    public function testReplaceStringWithPadding()
    {
        $string = " This is a string ";
        $expected = " This is a string ";
        $foo = new testType();
        $result = $foo->replaceString($string);
        $this->assertEquals($expected, $result);
    }

    public function testCollapseStringWithSpacesAndPadding()
    {
        $string = "  This  is  a  string  ";
        $expected = "This is a string";
        $foo = new testType();
        $result = $foo->collapseString($string);
        $this->assertEquals($expected, $result);
    }

    public function testSimpleIdentifierValidWithTrailingSpace()
    {
        $string = "UnitPrice ";

        $foo = new testType();
        $this->assertFalse($foo->isTSimpleIdentifierValid($string));
    }

    public function testSimpleIdentifierValidWithoutTrailingSpace()
    {
        $string = "UnitPrice";

        $foo = new testType();
        $this->assertTrue($foo->isTSimpleIdentifierValid($string));
    }

    public function testRegexPatternMatchAllOfString()
    {
        $string = "This! IS! UNITPRICE";

        $foo = new testType();
        $this->assertFalse($foo->isTSimpleIdentifierValid($string));
    }
}
