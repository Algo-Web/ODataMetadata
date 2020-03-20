<?php

namespace AlgoWeb\ODataMetadata\Tests\MetadataV3\Edm;

use AlgoWeb\ODataMetadata\MetadataV3\Edm\Documentation;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Using;
use AlgoWeb\ODataMetadata\Tests\TestCase;

class UsingTest extends TestCase
{
    /**
     * @param $expected
     * @param $namespace
     * @param $alias
     * @param $documentation
     * @dataProvider usingTestDataProvider
     */
    public function testUsingTestXmlSerialize($expected,$namespace,$alias, $documentation)
    {
        $using = new Using($namespace,$alias,$documentation);

        $domNode = $this->writterContext->write($using, false);
        $this->TESTNODE->appendChild($domNode);
        $xml = $this->writterContext->getBaseDocument()->saveXML($domNode);
        $this->assertEquals($expected, $xml);
    }

    public static function usingTestDataProvider()
    {
        $baseArray = [
            [
                '<Using Namespace="TestNamespace" Alias="TestAlias"/>',
                'TestNamespace',
                'TestAlias',
                null
            ],
            [
                '<Using Namespace="TestNamespace" Alias="TestAlias"><Documentation><Summary>Short Summery</Summary></Documentation></Using>',
                'TestNamespace',
                'TestAlias',
                new Documentation('Short Summery')

            ]
        ];
        return $baseArray;
    }
}
