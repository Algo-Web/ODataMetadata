<?php

namespace AlgoWeb\ODataMetadata\Tests\MetadataV3\Edm;

use AlgoWeb\ODataMetadata\MetadataV3\Edm\PropertyRef;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Using;
use AlgoWeb\ODataMetadata\Tests\TestCase;

class PropertyRefTest extends TestCase
{
    public function testPropertyRefXmlSerialize()
    {
        $propRef = new PropertyRef('CustomerId');
        $domNode = $this->writerContext->write($propRef, false);
        $this->TESTNODE->appendChild($domNode);
        $xml = $this->writerContext->getBaseDocument()->saveXML($domNode);
        $this->assertXmlStringEqualsXmlString('<PropertyRef Name="CustomerId" />', $xml);
    }
}
