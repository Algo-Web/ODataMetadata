<?php

namespace AlgoWeb\ODataMetadata\Tests\MetadataV3\Edmx;

use AlgoWeb\ODataMetadata\MetadataV3\Edmx\DataServices;
use AlgoWeb\ODataMetadata\OdataVersions;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use AlgoWeb\ODataMetadata\Writer\WriterContext;

class DataServicesTest extends TestCase
{
    public function testDataServicesXmlSerialize()
    {
        $dataService = new DataServices();
        $domNode = $this->writerContext->write($dataService, false);
        $this->TESTNODE->appendChild($domNode);
        $xml = $this->writerContext->getBaseDocument()->saveXML($domNode);
        $this->assertXmlStringEqualsXmlString('<edmx:DataServices metadata:DataServiceVersion="3.0"><Schema xmlns="http://schemas.microsoft.com/ado/2009/11/edm"/></edmx:DataServices>', $xml);
    }
}
