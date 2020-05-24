<?php

namespace AlgoWeb\ODataMetadata\Tests\MetadataV3\Edm\EntityType;

use AlgoWeb\ODataMetadata\MetadataV3\Edm\EntityType\KeyElement;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\PropertyRef;
use AlgoWeb\ODataMetadata\Tests\TestCase;

class KeyElementTest extends TestCase
{
    /**
     * @dataProvider KeyElementProvider
     */
    public function testKeyElementXmlSerialize($expected, $propertyRefArray)
    {
        $key = new KeyElement();
        foreach($propertyRefArray as $proRef){
            $key[]=$proRef;
        }
        $domNode = $this->writerContext->write($key, false);
        $this->TESTNODE->appendChild($domNode);
        $xml = $this->writerContext->getBaseDocument()->saveXML($this->TESTNODE->firstChild);
        $this->assertXmlStringEqualsXmlString($expected, $xml);
    }

    public static function KeyElementProvider(){
        return [
            [
                '<Key>' .
                '    <PropertyRef Name="ID"/>' .
                '</Key>', [new PropertyRef("ID")]
            ],
            [
                '<Key>' .
                '    <PropertyRef Name="OrderID"/>' .
                '    <PropertyRef Name="LineNumber"/>' .
                '</Key>', [new PropertyRef("OrderID"), new PropertyRef('LineNumber')]
            ]
        ];

    }
}