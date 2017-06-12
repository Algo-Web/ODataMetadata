<?php

namespace AlgoWeb\ODataMetadata\Tests\v3\edm;

use AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionImportReturnTypeType;
use AlgoWeb\ODataMetadata\Tests\TestCase;

class TFunctionImportReturnTypeTypeTest extends TestCase
{
    public function testFunctionImportParameterAndReturnTypeNonString()
    {
        $expected = "Input must be a string: AlgoWeb\\ODataMetadata\\MetadataV3\\edm\\TFunctionImportReturnTypeType";
        $actual = null;

        $type = new \DateTime();
        $foo = new TFunctionImportReturnTypeType();

        try {
            $foo->isTFunctionImportParameterAndReturnTypeValid($type);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testIsTPropertyTypeValidBlankString()
    {
        $type = " _ ";
        $foo = new TFunctionImportReturnTypeType();
        $this->assertFalse($foo->isTFunctionImportParameterAndReturnTypeValid($type));
    }

    public function testIsTPropertyTypeValidEDMSimpleType()
    {
        $type = "String";
        $foo = new TFunctionImportReturnTypeType();
        $this->assertTrue($foo->isTFunctionImportParameterAndReturnTypeValid($type));
    }
}
