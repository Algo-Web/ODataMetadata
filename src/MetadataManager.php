<?php

namespace AlgoWeb\ODataMetadata;

use AlgoWeb\ODataMetadata\MetadataV3\edm\EntityContainer\EntitySetAnonymousType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TAssociationEndType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TAssociationType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TConstraintType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TDocumentationType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TEntityPropertyType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TEntityTypeType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyRefType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TReferentialConstraintRoleElementType;
use AlgoWeb\ODataMetadata\MetadataV3\edmx\Edmx;
use JMS\Serializer\SerializerBuilder;

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
            SerializerBuilder::create()
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

    public function addEntityType($name, $accessType = "Public", $summary = null, $longDescription = null)
    {
        $this->startEdmxTransaction();
        $NewEntity = new TEntityTypeType();
        $NewEntity->setName($name);
        if (null != $summary || null != $longDescription) {
            $documentation = new TDocumentationType();
            $documentation->setSummary($summary);
            $documentation->setLongDescription($longDescription);
            $NewEntity->setDocumentation($documentation);
        }

        $entitySet = new EntitySetAnonymousType();
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
     * @param string $plural Plural form of word; function will attempt to deduce plural
     * form from singular if not provided
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

    private function revertEdmxTransaction()
    {
        $this->V3Edmx = unserialize($this->oldEdmx);
    }

    private function commitEdmxTransaction()
    {
        $this->oldEdmx = null;
    }

    public function addPropertyToEntityType(
        $entityType,
        $name,
        $type,
        $defaultValue = null,
        $nullable = false,
        $isKey = false,
        $storeGeneratedPattern = false,
        $summary = null,
        $longDescription = null
    ) {
        $this->startEdmxTransaction();
        $NewProperty = new TEntityPropertyType();
        $NewProperty->setName($name);
        $NewProperty->setType($type);
        $NewProperty->setStoreGeneratedPattern($storeGeneratedPattern);
        $NewProperty->setNullable($nullable);
        if (null != $summary || null != $longDescription) {
            $documentation = new TDocumentationType();
            $documentation->setSummary($summary);
            $documentation->setLongDescription($longDescription);
            $NewProperty->addToDocumentation($documentation);
        }
        if (null != $defaultValue) {
            $NewProperty->setDefaultValue($defaultValue);
        }
        $entityType->addToProperty($NewProperty);
        if ($isKey) {
            $Key = new TPropertyRefType();
            $Key->setName($name);
            $entityType->addToKey($Key);
        }
        if (!$this->V3Edmx->isok($this->lastError)) {
            $this->revertEdmxTransaction();
            return false;
        }
        $this->commitEdmxTransaction();
        return $NewProperty;
    }

    public function addNavigationPropertyToEntityType($entityType)
    {
    }

    public function addComplexType(\ReflectionClass $refClass, $name, $namespace = null, $baseResourceType = null)
    {
        return $this->createResourceType($refClass, $name, $namespace, ResourceTypeKind::COMPLEX, $baseResourceType);
    }

    public function getLastError()
    {
        return $this->lastError;
    }

    private function addAssocation(
        $principalType,
        $principalProperty,
        $principalMultiplicity,
        $dependentType,
        $dependentProperty,
        $dependentMultiplicity,
        array $principalConstraintProperty = null,
        array $dependentConstraintProperty = null
    ) {
        $association = new TAssociationType();
        $name = $principalType . "_" . $principalProperty . "_" . $dependentType . "_" . $dependentProperty;
        $name = trim($name, "_");
        $association->setName($name);

        $principalEnd = new TAssociationEndType();
        $principalEnd->setType($principalType);
        $principalEnd->setRole($principalType . "_" . $principalProperty . "_" . $dependentType);
        $principalEnd->setMultiplicity($principalMultiplicity);
        $dependentEnd = new TAssociationEndType();
        $dependentEnd->setType($dependentType);
        $dependentEnd->setRole($dependentType . "_" . $dependentProperty . "_" . $principalType);
        $dependentEnd->setMultiplicity($dependentMultiplicity);
        $association->addToEnd($principalEnd);
        $association->addToEnd($dependentEnd);
        $principalReferralConstraint = null;
        $dependentReferralConstraint = null;
        if (null != $principalConstraintProperty && 0 < count($principalConstraintProperty)) {
            $principalReferralConstraint = new TReferentialConstraintRoleElementType();
            $principalReferralConstraint->setRole($principalType . "_" . $principalProperty . "_" . $dependentType);
            foreach ($principalConstraintProperty as $pripertyRef) {
                $principalReferralConstraint->addToPropertyRef($pripertyRef);
            }
        }
        if (null != $dependentConstraintProperty && 0 < count($dependentConstraintProperty)) {
            $dependentReferralConstraint = new TReferentialConstraintRoleElementType();
            $dependentReferralConstraint->setRole($dependentType . "_" . $dependentProperty . "_" . $principalType);
            foreach ($dependentConstraintProperty as $pripertyRef) {
                $dependentReferralConstraint->addToPropertyRef($pripertyRef);
            }
        }

        if (null != $dependentReferralConstraint || null != $principalReferralConstraint) {
            $constraint = new TConstraintType();
            $constraint->setPrincipal($principalReferralConstraint);
            $constraint->setDependent($dependentReferralConstraint);
            $association->setReferentialConstraint($constraint);
        }
        return $association;
    }
}
