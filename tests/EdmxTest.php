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
        $ds = DIRECTORY_SEPARATOR;
        $msg = null;
        $edmx = new Edmx();
        $this->assertTrue($edmx->isOK($msg), $msg);
        $this->assertNull($msg);
        $ymlDir = dirname(__DIR__) . $ds . "src" . $ds . "MetadataV3" . $ds . "JMSmetadata";
        $serializer =
            \JMS\Serializer\SerializerBuilder::create()
                ->addMetadataDir($ymlDir)
                ->build();
        $d = $serializer->serialize($edmx, "xml");
        $this->v3MetadataAgainstXSD($d);
    }

    public function v3MetadataAgainstXSD($data)
    {
        $ds = DIRECTORY_SEPARATOR;
        $xml = new \DOMDocument();
        $xml->loadXML($data);
        $xml->schemaValidate(dirname(__DIR__) . $ds . "xsd" . $ds . "/Microsoft.Data.Entity.Design.Edmx_3.xsd");
    }

    public function testWithSingleEntitySerializeOk()
    {
        $ds = DIRECTORY_SEPARATOR;
        $msg = null;
        $NewEntity = new \AlgoWeb\ODataMetadata\MetadataV3\edm\TEntityTypeType();
        $NewEntity->setName("simpleEntityType");
        $this->assertTrue($NewEntity->isOK($msg), $msg);
        $this->assertNull($msg);
        $edmx = new Edmx();
        $edmx->getDataServices()[0]->addToEntityType($NewEntity);
        $this->assertTrue($edmx->isOK($msg), $msg);
        $this->assertNull($msg);


        $ymlDir = dirname(__DIR__) . $ds . "src" . $ds . "MetadataV3" . $ds . "JMSmetadata";
        $serializer =
            \JMS\Serializer\SerializerBuilder::create()
                ->addMetadataDir($ymlDir)
                ->build();
        $d = $serializer->serialize($edmx, "xml");
        $this->v3MetadataAgainstXSD($d);
    }

    public function testWithSingleEntityWithPropertiesSerializeOk()
    {
        $ds = DIRECTORY_SEPARATOR;
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


        $ymlDir = dirname(__DIR__) . $ds . "src" . $ds . "MetadataV3" . $ds . "JMSmetadata";
        $serializer =
            \JMS\Serializer\SerializerBuilder::create()
                ->addMetadataDir($ymlDir)
                ->build();
        $d = $serializer->serialize($edmx, "xml");
        $this->v3MetadataAgainstXSD($d);
    }
}
