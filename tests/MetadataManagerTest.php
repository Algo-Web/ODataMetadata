<?php
/**
 * Created by PhpStorm.
 * User: Doc
 * Date: 5/11/2017
 * Time: 11:01 PM
 */

namespace AlgoWeb\ODataMetadata\Tests;

use AlgoWeb\ODataMetadata\MetadataManager;

class MetadataManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testIsOKAtDefault()
    {
        $ds = DIRECTORY_SEPARATOR;
        $metadataManager = new MetadataManager();
        $msg = null;
        $edmx = $metadataManager->getEdmx();
        $this->assertTrue($edmx->isOK($msg), $msg);
        $this->assertNull($msg);

        $d = $metadataManager->getEdmxXML();
        $this->v3MetadataAgainstXSD($d);
    }

    public function v3MetadataAgainstXSD($data)
    {
        $ds = DIRECTORY_SEPARATOR;
        $xml = new \DOMDocument();
        $xml->loadXML($data);
        $xml->schemaValidate(dirname(__DIR__) . $ds . "xsd" . $ds . "/Microsoft.Data.Entity.Design.Edmx_3.xsd");
    }

    public function testEntitysAndProperties()
    {
        $metadataManager = new MetadataManager();

        $eType = $metadataManager->addEntityType("Category");
        $this->assertNotFalse($eType, "Etype is false not type " . $metadataManager->getLastError());
        $metadataManager->addPropertyToEntityType($eType, "CategoryID", "Int32", null, false, true, "Identity");
        $metadataManager->addPropertyToEntityType($eType, "CategoryName", "String");
        $metadataManager->addPropertyToEntityType($eType, "Description", "String");
        $metadataManager->addPropertyToEntityType($eType, "Picture", "Binary");

        $eType = $metadataManager->addEntityType("CustomerDemographic");
        $metadataManager->addPropertyToEntityType($eType, "CustomerTypeID", "String", null, false, true);
        $metadataManager->addPropertyToEntityType($eType, "CustomerDesc", "String");


        $msg = null;
        $edmx = $metadataManager->getEdmx();
        $this->assertTrue($edmx->isOK($msg), $msg);
        $this->assertNull($msg);

        $d = $metadataManager->getEdmxXML();
        die($d);
        $this->v3MetadataAgainstXSD($d);
    }


}
