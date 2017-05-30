<?php

namespace AlgoWeb\ODataMetadata\Tests;

use AlgoWeb\ODataMetadata\MetadataV3\edm\Schema;
use AlgoWeb\ODataMetadata\MetadataV3\edmx\Edmx;

use Illuminate\Support\Str;

use AlgoWeb\ODataMetadata\MetadataV3\edmx\TDataServicesType;
use AlgoWeb\ODataMetadata\MetadataV3\edmx\TEdmxType;

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

        $goodxsd = dirname(__DIR__) . $ds . "xsd" . $ds . "Microsoft.Data.Entity.Design.Edmx_3.Fixed.xsd";
        if (!file_exists($goodxsd)) {
            return true;
        }
        $xml = new \DOMDocument();
        $xml->loadXML($data);
        $xml->schemaValidate($goodxsd);
        return true;
    }

    public function testDefaultSerializeDeserializeRoundTrip()
    {
        $ds = DIRECTORY_SEPARATOR;
        $msg = null;
        $edmx = new Edmx();
        $this->assertTrue($edmx->isOK($msg), $msg);
        $this->assertNull($msg);
        $this->checkEdmxSerialiseDeserialiseRoundTrip($ds, $edmx, $msg);
    }

    /**
     * @param $ds
     * @param $edmx
     * @param $msg
     */
    private function checkEdmxSerialiseDeserialiseRoundTrip($ds, $edmx, $msg)
    {
        $ymlDir = dirname(__DIR__) . $ds . "src" . $ds . "MetadataV3" . $ds . "JMSmetadata";
        $serializer =
            \JMS\Serializer\SerializerBuilder::create()
                ->addMetadataDir($ymlDir)
                ->build();
        $d1 = $serializer->serialize($edmx, "xml");
        $this->v3MetadataAgainstXSD($d1);
        $edmxElectricBoogaloo = $serializer->deserialize($d1, get_class($edmx), 'xml');
        $this->assertTrue($edmxElectricBoogaloo->isOK($msg), $msg);
        $this->assertEquals($edmx, $edmxElectricBoogaloo);
        // and final serialize pass to further constrain undetected misbehaviour
        $d2 = $serializer->serialize($edmxElectricBoogaloo, 'xml');
        $this->v3MetadataAgainstXSD($d2);
        $this->assertEquals($d1, $d2);
    }

    public function testFirstLevelSerializeDeserializeRoundTrip()
    {
        $ds = DIRECTORY_SEPARATOR;
        $msg = null;
        $schema = new Schema('data', 'metadata');
        $this->assertTrue($schema->isOK($msg), $msg);
        $services = new TDataServicesType('3.0', '1.0');
        $services->addToSchema($schema);
        $this->assertTrue($services->isOK($msg), $msg);
        $edmx = new Edmx();
        $edmx->setDataServiceType($services);
        $this->assertTrue($edmx->isOK($msg), $msg);
        $this->assertNull($msg);

        $this->checkEdmxSerialiseDeserialiseRoundTrip($ds, $edmx, $msg);
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
        $edmx->getDataServiceType()->getSchema()[0]->addToEntityType($NewEntity);
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

    public function testWithSingleEntitySerializeDeserializeRoundTrip()
    {
        $ds = DIRECTORY_SEPARATOR;
        $msg = null;
        $NewEntity = new \AlgoWeb\ODataMetadata\MetadataV3\edm\TEntityTypeType();
        $NewEntity->setName("simpleEntityType");
        $this->assertTrue($NewEntity->isOK($msg), $msg);
        $this->assertNull($msg);
        $edmx = new Edmx();
        $edmx->getDataServiceType()->getSchema()[0]->addToEntityType($NewEntity);
        $this->assertTrue($edmx->isOK($msg), $msg);
        $this->assertNull($msg);

        $this->checkEdmxSerialiseDeserialiseRoundTrip($ds, $edmx, $msg);
    }

    public function testKnownGoodV3DocumentDeserialiseToOk()
    {
        $this->markTestSkipped('Skipped until service-document models get implemented');
        $ds = DIRECTORY_SEPARATOR;
        $msg = null;

        $docLocation = dirname(__DIR__) . $ds . "tests" . $ds . "exampleV3ServiceDocument.xml";
        $document = file_get_contents($docLocation);
        $type = 'AlgoWeb\ODataMetadata\MetadataV3\edmx\TDataServicesType';
        $ymlDir = dirname(__DIR__) . $ds . "src" . $ds . "MetadataV3" . $ds . "JMSmetadata";

        $serializer =
            \JMS\Serializer\SerializerBuilder::create()
                ->addMetadataDir($ymlDir)
                ->build();

        $d = $serializer->deserialize($document, $type, 'xml');
        $this->assertTrue($d instanceof TDataServicesType, get_class($this));
        $this->assertTrue($d->isOK($msg), $msg);
    }

    public function testKnownGoodV3MetadataDeserialiseToOk()
    {
        $ds = DIRECTORY_SEPARATOR;
        $msg = null;

        $docLocation = dirname(__DIR__) . $ds . "tests" . $ds . "exampleV3ServiceMetadata.xml";
        $document = file_get_contents($docLocation);
        $type = 'AlgoWeb\ODataMetadata\MetadataV3\edmx\Edmx';
        $ymlDir = dirname(__DIR__) . $ds . "src" . $ds . "MetadataV3" . $ds . "JMSmetadata";

        $serializer =
            \JMS\Serializer\SerializerBuilder::create()
                ->addMetadataDir($ymlDir)
                ->build();

        $d = $serializer->deserialize($document, $type, 'xml');
        $this->assertTrue($d instanceof TEdmxType, get_class($d));
        $this->assertTrue($d->isOK($msg), $msg);
    }

    public function testKnownGoodV3MetadataDeserialiseToOkSerializeDeserializeRoundTrip()
    {
        $this->markTestSkipped();
        $ds = DIRECTORY_SEPARATOR;
        $msg = null;

        $docLocation = dirname(__DIR__) . $ds . "tests" . $ds . "exampleV3ServiceMetadata.xml";
        $document = file_get_contents($docLocation);
        $this->v3MetadataAgainstXSD($document);
        $type = 'AlgoWeb\ODataMetadata\MetadataV3\edmx\Edmx';
        $ymlDir = dirname(__DIR__) . $ds . "src" . $ds . "MetadataV3" . $ds . "JMSmetadata";

        $serializer =
            \JMS\Serializer\SerializerBuilder::create()
                ->addMetadataDir($ymlDir)
                ->build();

        $d = $serializer->deserialize($document, $type, 'xml');
        $this->assertTrue($d instanceof TEdmxType, get_class($d));
        $this->assertTrue($d->isOK($msg), $msg);
        $this->checkEdmxSerialiseDeserialiseRoundTrip($ds, $d, $msg);
    }

    public function testWithSingleEntityWithPropertiesSerializeOk()
    {
        $ds = DIRECTORY_SEPARATOR;
        $msg = null;
        $NewProperty = new \AlgoWeb\ODataMetadata\MetadataV3\edm\TEntityPropertyType();
        $NewProperty->setName("TheFirstProperty");
        $NewProperty->setType("String");
        $this->assertTrue($NewProperty->isOK($msg), $msg);
        $this->assertNull($msg);

        $NewEntity = new \AlgoWeb\ODataMetadata\MetadataV3\edm\TEntityTypeType();
        $NewEntity->setName("simpleEntityType");
        $NewEntity->addToProperty($NewProperty);
        $this->assertTrue($NewEntity->isOK($msg), $msg);
        $this->assertNull($msg);

        $entitySet = new \AlgoWeb\ODataMetadata\MetadataV3\edm\EntityContainer\EntitySetAnonymousType();
        $entitySet->setName(Str::plural($NewEntity->getName(), 2));
        $entitySet->setEntityType($NewEntity->getName());
        $this->assertTrue($entitySet->isOK($msg), $msg);
        $this->assertNull($msg);
        $edmx = new Edmx();
        $edmx->getDataServiceType()->getSchema()[0]->addToEntityType($NewEntity);
        $edmx->getDataServiceType()->getSchema()[0]->getEntityContainer()[0]->addToEntitySet($entitySet);
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

    public function testWithSingleEntityWithPropertiesSerializeDeserializeRoundTrip()
    {
        $ds = DIRECTORY_SEPARATOR;
        $msg = null;
        $NewProperty = new \AlgoWeb\ODataMetadata\MetadataV3\edm\TEntityPropertyType();
        $NewProperty->setName("TheFirstProperty");
        $NewProperty->setType("String");
        $this->assertTrue($NewProperty->isOK($msg), $msg);
        $this->assertNull($msg);

        $NewEntity = new \AlgoWeb\ODataMetadata\MetadataV3\edm\TEntityTypeType();
        $NewEntity->setName("simpleEntityType");
        $NewEntity->addToProperty($NewProperty);
        $this->assertTrue($NewEntity->isOK($msg), $msg);
        $this->assertNull($msg);

        $entitySet = new \AlgoWeb\ODataMetadata\MetadataV3\edm\EntityContainer\EntitySetAnonymousType();
        $entitySet->setName(Str::plural($NewEntity->getName(), 2));
        $entitySet->setEntityType($NewEntity->getName());
        $this->assertTrue($entitySet->isOK($msg), $msg);
        $this->assertNull($msg);
        $edmx = new Edmx();
        $edmx->getDataServiceType()->getSchema()[0]->addToEntityType($NewEntity);
        $edmx->getDataServiceType()->getSchema()[0]->getEntityContainer()[0]->addToEntitySet($entitySet);
        $this->assertTrue($edmx->isOK($msg), $msg);
        $this->assertNull($msg);

        $this->checkEdmxSerialiseDeserialiseRoundTrip($ds, $edmx, $msg);
    }

    public function testWithSingleEntityWithoutPropertiesSerializeDeserializeRoundTrip()
    {
        $ds = DIRECTORY_SEPARATOR;
        $msg = null;

        $NewEntity = new \AlgoWeb\ODataMetadata\MetadataV3\edm\TEntityTypeType();
        $NewEntity->setName("simpleEntityType");
        $this->assertTrue($NewEntity->isOK($msg), $msg);
        $this->assertNull($msg);

        $entitySet = new \AlgoWeb\ODataMetadata\MetadataV3\edm\EntityContainer\EntitySetAnonymousType();
        $entitySet->setName(Str::plural($NewEntity->getName(), 2));
        $entitySet->setEntityType($NewEntity->getName());
        $this->assertTrue($entitySet->isOK($msg), $msg);
        $this->assertNull($msg);
        $edmx = new Edmx();
        $edmx->getDataServiceType()->getSchema()[0]->addToEntityType($NewEntity);
        $edmx->getDataServiceType()->getSchema()[0]->getEntityContainer()[0]->addToEntitySet($entitySet);
        $this->assertTrue($edmx->isOK($msg), $msg);
        $this->assertNull($msg);

        $this->checkEdmxSerialiseDeserialiseRoundTrip($ds, $edmx, $msg);
    }
}
