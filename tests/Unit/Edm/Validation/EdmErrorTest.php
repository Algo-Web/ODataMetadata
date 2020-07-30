<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 30/07/20
 * Time: 9:41 PM.
 */

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Tests\Unit\Edm\Validation;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;
use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Interfaces\ILocation;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class EdmErrorTest extends TestCase
{
    public function testToStringEmpty()
    {
        $errorCode = EdmErrorCode::FunctionImportEntityTypeDoesNotMatchEntitySet();

        $foo = new EdmError(null, $errorCode, '');

        $expected = 'FunctionImportEntityTypeDoesNotMatchEntitySet=149:';
        $actual   = $foo->__toString();
        $this->assertEquals($expected, $actual);
    }

    public function testToStringWithLocation()
    {
        $errorCode = EdmErrorCode::FunctionImportEntityTypeDoesNotMatchEntitySet();
        $loc       = m::mock(ILocation::class);
        $loc->shouldReceive('__toString')->andReturn('rhubarb');

        $foo = new EdmError($loc, $errorCode, '');

        $expected = 'FunctionImportEntityTypeDoesNotMatchEntitySet=149::rhubarb';
        $actual   = $foo->__toString();
        $this->assertEquals($expected, $actual);
    }
}
