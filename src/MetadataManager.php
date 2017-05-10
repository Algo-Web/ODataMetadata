<?php

namespace AlgoWeb\ODataMetadata;

use AlgoWeb\ODataMetadata\MetadataV3\edm\TEntityTypeType;
use AlgoWeb\ODataMetadata\MetadataV3\edmx\Edmx;

class MetadataManager
{
    private $V3Edmx = null;

    private $serializer = null;

    public function __construct($namespaceName = "Data", $containerName = "DefaultContainer")
    {
        $this->V3Edmx = new Edmx($namespaceName, $containerName);
        if (!$this->V3Edmx->isOK($msg)) {
            throw new \Exception($msg);
        }
        $ymlDir = dirname(__DIR__) . DIRECTORY_SEPARATOR . "MetadataV3" . DIRECTORY_SEPARATOR . "JMSmetadata";
        $this->serializer =
            \JMS\Serializer\SerializerBuilder::create()
                ->addMetadataDir($ymlDir)
                ->build();
    }

    public function getEdmx()
    {
        return $this->V3Edmx;
    }

    public function getEdmxXML()
    {
        return $this->serializer->serialize($this->edmx, "xml");
    }

    public function addEntityType($refClass, $name, $namespace = null)
    {
        $NewEntity = new TEntityTypeType();
        return $this->createResourceType($refClass, $name, $namespace, ResourceTypeKind::ENTITY, null);
    }

    public function addComplexType(\ReflectionClass $refClass, $name, $namespace = null, $baseResourceType = null)
    {
        return $this->createResourceType($refClass, $name, $namespace, ResourceTypeKind::COMPLEX, $baseResourceType);
    }


}