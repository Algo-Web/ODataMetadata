<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 2/07/20
 * Time: 2:45 PM.
 */
namespace AlgoWeb\ODataMetadata\Tests\Unit;

use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Tests\TestCase;

class EdmUtilTest extends TestCase
{
    public function testIsNullOrWhitespaceInternalWithNull()
    {
        $value = null;

        $expected = true;
        $actual   = EdmUtil::IsNullOrWhiteSpaceInternal($value);
        $this->assertEquals($expected, $actual);
    }

    public function testIsNullOrWhitespaceInternalWithEmptyString()
    {
        $value = '';

        $expected = true;
        $actual   = EdmUtil::IsNullOrWhiteSpaceInternal($value);
        $this->assertEquals($expected, $actual);
    }

    public function testIsNullOrWhitespaceInternalWithWhitespaceString()
    {
        $value = " \t\n\r\0\x0B";

        $expected = true;
        $actual   = EdmUtil::IsNullOrWhiteSpaceInternal($value);
        $this->assertEquals($expected, $actual);
    }
}
