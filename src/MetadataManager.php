<?php

namespace AlgoWeb\ODataMetadata;

use AlgoWeb\ODataMetadata\MetadataV3\edm\TEntityTypeType;
use AlgoWeb\ODataMetadata\MetadataV3\edmx\Edmx;

class MetadataManager
{
    private $V3Edmx = null;
    private $oldEdmx = null;
    private $lastError = null;
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
        return $this->serializer->serialize($this->V3Edmx, "xml");
    }

    public function addEntityType($name, $accessType = "Public")
    {
        $this->startEdmxTransaction();
        $NewEntity = new TEntityTypeType();
        $NewEntity->setName($name);


        $entitySet = new \AlgoWeb\ODataMetadata\MetadataV3\edm\EntityContainer\EntitySetAnonymousType();
        $entitySet->setName($this->pluralize(2, $NewEntity->getName()));
        $namespace = $this->V3Edmx->getDataServices()[0]->getNamespace();
        if (0 == strlen(trim($namespace))) {
            $entityTypeName = $NewEntity->getName();
        } else {
            $entityTypeName = $namespace . "." . $NewEntity->getName();
        }
        $entitySet->setEntityType($entityTypeName);
        $entitySet->setGetterAccess($accessType);

        $this->V3Edmx->getDataServices()[0]->addToEntityType($NewEntity);
        $this->V3Edmx->getDataServices()[0]->getEntityContainer()[0]->addToEntitySet($entitySet);
        if (!$this->V3Edmx->isok($this->lastError)) {
            $this->revertEdmxTransaction();
            return false;
        }
        $this->commitEdmxTransaction();
        return $NewEntity;
    }

    private function startEdmxTransaction()
    {
        $this->oldEdmx = serialize($this->V3Edmx);
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
        if ($quantity == 1 || !strlen($singular)) return $singular;
        if ($plural !== null) return $plural;

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

    private function revertEdmxTransaction()
    {
        $this->V3Edmx = unserialize($this->oldEdmx);
    }

    private function commitEdmxTransaction()
    {
        $this->oldEdmx == null;
    }

    public function addPropertyToEntityType($entityType, $name, $type, $isKey = false)
    {
        $this->startEdmxTransaction();
        $NewProperty = new \AlgoWeb\ODataMetadata\MetadataV3\edm\TEntityPropertyType();
        $NewProperty->setName("$name");
        $NewProperty->setType("$type");
        $entityType->addToProperty($NewProperty);
        if (!$this->V3Edmx->isok($this->lastError)) {
            $this->revertEdmxTransaction();
            return false;
        }
        $this->commitEdmxTransaction();
        return $NewProperty;
    }

    public function addComplexType(\ReflectionClass $refClass, $name, $namespace = null, $baseResourceType = null)
    {
        return $this->createResourceType($refClass, $name, $namespace, ResourceTypeKind::COMPLEX, $baseResourceType);
    }

    public function getLastError()
    {
        return $this->lastError();
    }
}
