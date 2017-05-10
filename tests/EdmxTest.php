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
        $this->assertNull($msg);
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

    public function testWithSingleEntitySerializeOk()
    {
        $msg = null;
        $NewEntity = new \AlgoWeb\ODataMetadata\MetadataV3\edm\TEntityTypeType();
        $NewEntity->setName("simpleEntityType");
        $this->assertTrue($NewEntity->isOK($msg), $msg);
        $this->assertNull($msg);
        $edmx = new Edmx();
        $edmx->getDataServices()[0]->addToEntityType($NewEntity);
        $this->assertTrue($edmx->isOK($msg), $msg);
        $this->assertNull($msg);


        $ymlDir = dirname(__DIR__) . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "MetadataV3" . DIRECTORY_SEPARATOR . "JMSmetadata";
        $serializer =
            \JMS\Serializer\SerializerBuilder::create()
                ->addMetadataDir($ymlDir)
                ->build();
        $d = $serializer->serialize($edmx, "xml");
        $this->V3MetadataAgainstXSD($d);
    }

    public function testWithSingleEntityWithPropertiesSerializeOk()
    {
        $msg = null;
        $NewProperty = new \AlgoWeb\ODataMetadata\MetadataV3\edm\TEntityPropertyType();
        $this->assertTrue($NewProperty->isOK($msg), $msg);
        $this->assertNull($msg);

        $NewEntity = new \AlgoWeb\ODataMetadata\MetadataV3\edm\TEntityTypeType();
        $NewEntity->setName("simpleEntityType");
        $this->assertTrue($NewEntity->isOK($msg), $msg);
        $this->assertNull($msg);
        $edmx = new Edmx();
        $edmx->getDataServices()[0]->addToEntityType($NewEntity);
        $this->assertTrue($edmx->isOK($msg), $msg);
        $this->assertNull($msg);


        $ymlDir = dirname(__DIR__) . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "MetadataV3" . DIRECTORY_SEPARATOR . "JMSmetadata";
        $serializer =
            \JMS\Serializer\SerializerBuilder::create()
                ->addMetadataDir($ymlDir)
                ->build();
        $d = $serializer->serialize($edmx, "xml");
        $this->V3MetadataAgainstXSD($d);
    }
}
