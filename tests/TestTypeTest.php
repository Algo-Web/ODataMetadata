<?php

namespace AlgoWeb\ODataMetadata\Tests;

use phpDocumentor\Reflection\Types\This;
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
        $expected = "Child item is not an instance of IsOK";
        $arr = ['abc'];

        $foo = new testType();
        $this->assertFalse($foo->isChildArrayOK($arr, $msg), $msg);
        $this->assertEquals($expected, $msg);
    }

    public function testIsChildArrayOkForNonEmptyArrayWithGoodGubbinsNotOk()
    {
        $bar = m::mock(TestType::class);
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
}
