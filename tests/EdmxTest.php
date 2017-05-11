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
        $entitySet->setName($this->pluralize(2, $NewEntity->getName()));
        $entitySet->setEntityType($NewEntity->getname());
        $this->assertTrue($entitySet->isOK($msg), $msg);
        $this->assertNull($msg);
        $edmx = new Edmx();
        $edmx->getDataServices()[0]->addToEntityType($NewEntity);
        $edmx->getDataServices()[0]->getEntityContainer()[0]->addToEntitySet($entitySet);
        $this->assertTrue($edmx->isOK($msg), $msg);
        $this->assertNull($msg);


        $ymlDir = dirname(__DIR__) . $ds . "src" . $ds . "MetadataV3" . $ds . "JMSmetadata";
        $serializer =
            \JMS\Serializer\SerializerBuilder::create()
                ->addMetadataDir($ymlDir)
                ->build();
        $d = $serializer->serialize($edmx, "xml");
        die($d);
        $this->v3MetadataAgainstXSD($d);
    }

    /**
     * Pluralizes a word if quantity is not one.
     *
     * @param int $quantity Number of items
     * @param string $singular Singular form of word
     * @param string $plural Plural form of word; function will attempt to deduce plural form from singular if not provided
     * @return string Pluralized word if quantity is not one, otherwise singular
     */
    public static function pluralize($quantity, $singular, $plural = null)
    {
        if ($quantity == 1 || !strlen($singular)) {
            return $singular;
        }
        if ($plural !== null) {
            return $plural;
        }

        $last_letter = strtolower($singular[strlen($singular) - 1]);
        switch ($last_letter) {
            case 'y':
                return substr($singular, 0, -1) . 'ies';
            case 's':
                return $singular . 'es';
            default:
                return $singular . 's';
        }
    }
}
