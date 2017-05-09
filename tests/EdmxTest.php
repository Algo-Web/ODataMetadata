<?php

namespace AlgoWeb\ODataMetadata\Tests;

use AlgoWeb\ODataMetadata\MetadataV3\edmx\Edmx;

class EdmxTest extends TestCase
{
    public function testIsOKAtDefault()
    {
        $msg = null;
        $edmx = new Edmx();
        $this->assertTrue($edmx->isOK($msg), $msg);
    }

    public function testDefaultSerializeOk()
    {
        $msg = null;
        $edmx = new Edmx();
        $this->assertTrue($edmx->isOK($msg), $msg);
        $ymlDir = dirname(__DIR__) . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "MetadataV3" . DIRECTORY_SEPARATOR . "JMSmetadata";
        $serializer =
            \JMS\Serializer\SerializerBuilder::create()
                ->addMetadataDir($ymlDir)
                ->build();
        $d = $serializer->serialize($edmx, "xml");
        $this->V3MetadataAgainstXSD($d);
    }

    public function V3MetadataAgainstXSD($data)
    {

        $xml = new \DOMDocument();
        $xml->loadXML($data);
        $xml->schemaValidate(dirname(__DIR__) . DIRECTORY_SEPARATOR . "xsd" . DIRECTORY_SEPARATOR . "/Microsoft.Data.Entity.Design.Edmx_3.xsd");
    }
}
