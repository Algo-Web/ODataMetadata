<?php

namespace AlgoWeb\ODataMetadata;

use AlgoWeb\ODataMetadata\MetadataV3\edm\EntityContainer\AssociationSetAnonymousType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\EntityContainer\AssociationSetAnonymousType\EndAnonymousType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\EntityContainer\EntitySetAnonymousType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TAssociationEndType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TAssociationType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TConstraintType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TDocumentationType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TEntityPropertyType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TEntityTypeType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TNavigationPropertyType;
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
        $ymlDir = __DIR__ . DIRECTORY_SEPARATOR . "MetadataV3" . DIRECTORY_SEPARATOR . "JMSmetadata";
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
        $storeGeneratedPattern = null,
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

    public function addNavigationPropertyToEntityType(
        TEntityTypeType $principalType,
        $principalProperty,
        $principalMultiplicity,
        TEntityTypeType $dependentType,
        $dependentMultiplicity,
        $principalSummery = null,
        $principalLongDescription = null,
        $dependentSummery = null,
        $dependentLongDescription = null,
        $dependentProperty = "",
        array $principalConstraintProperty = null,
        array $dependentConstraintProperty = null,
        $principalGetterAccess = "Public",
        $principalSetterAccess = "Public",
        $dependentGetterAccess = "Public",
        $dependentSetterAccess = "Public"
    ) {
        $this->startEdmxTransaction();
        $principalEntitySetName = $this->pluralize(2, $principalType->getName());
        $dependentEntitySetName = $this->pluralize(2, $dependentType->getName());
        $relationName = $principalType->getName() . "_" . $principalProperty . "_" . $dependentType->getName() . "_" . $dependentProperty;
        $relationName = trim($relationName, "_");

        $namespace = $this->V3Edmx->getDataServices()[0]->getNamespace();
        if (0 == strlen(trim($namespace))) {
            $relationFQName = $relationName;
        } else {
            $relationFQName = $namespace . "." . $relationName;
        }

        $principalNavigationProperty = new TNavigationPropertyType();
        $principalNavigationProperty->setName($principalProperty);
        $principalNavigationProperty->setToRole($dependentEntitySetName . "_" . $dependentProperty);
        $principalNavigationProperty->setFromRole($principalEntitySetName . "_" . $principalProperty);
        $principalNavigationProperty->setRelationship($relationFQName);
        $principalNavigationProperty->setGetterAccess($principalGetterAccess);
        $principalNavigationProperty->setSetterAccess($principalSetterAccess);
        if (null != $principalSummery || null != $principalLongDescription) {
            $principalDocumentation = new TDocumentationType();
            $principalDocumentation->setSummary($principalSummery);
            $principalDocumentation->setLongDescription($principalLongDescription);
            $principalNavigationProperty->setDocumentation($principalDocumentation);
        }
        $principalType->addToNavigationProperty($principalNavigationProperty);


        if (!empty($dependentProperty)) {
            $dependentNavigationProperty = new TNavigationPropertyType();
            $dependentNavigationProperty->setName($dependentProperty);
            $dependentNavigationProperty->setToRole($principalEntitySetName . "_" . $principalProperty);
            $dependentNavigationProperty->setFromRole($dependentEntitySetName . "_" . $dependentProperty);
            $dependentNavigationProperty->setRelationship($relationFQName);
            $dependentNavigationProperty->setGetterAccess($dependentGetterAccess);
            $dependentNavigationProperty->setSetterAccess($dependentSetterAccess);
            if (null != $dependentSummery || null != $dependentLongDescription) {
                $dependentDocumentation = new TDocumentationType();
                $dependentDocumentation->setSummary($dependentSummery);
                $dependentDocumentation->setLongDescription($dependentLongDescription);
                $dependentNavigationProperty->setDocumentation($dependentDocumentation);
            }
            $dependentType->addToNavigationProperty($dependentNavigationProperty);
        }

        $assocation = createAssocationFromNavigationProperty(
            $principalType,
            $dependentType,
            $principalNavigationProperty,
            $dependentNavigationProperty,
            $principalMultiplicity,
            $dependentMultiplicity,
            $principalConstraintProperty,
            $dependentConstraintProperty
        );

        $this->V3Edmx->getDataServices()[0]->addToAssociation($assocation);

        $associationSet = createAssocationSetForAssocation($assocation, $principalEntitySetName, $dependentEntitySetName);

        $this->V3Edmx->getDataServices()[0]->getEntityContainer()[0]->addToAssociationSet($associationSet);


        if (!$this->V3Edmx->isok($this->lastError)) {
            $this->revertEdmxTransaction();
            return false;
        }
        $this->commitEdmxTransaction();
        return [$principalNavigationProperty, $dependentNavigationProperty];
    }

    public function getLastError()
    {
        return $this->lastError;
    }

    protected function createAssocationFromNavigationProperty(
        TEntityTypeType $principalType,
        TEntityTypeType $dependentType,
        TNavigationPropertyType $principalNavigationProperty,
        TNavigationPropertyType $dependentNavigationProperty = null,
        $principalMultiplicity,
        $dependentMultiplicity,
        array $principalConstraintProperty = null,
        array $dependentConstraintProperty = null

    ) {
        if (null != $dependentNavigationProperty) {
            if ($dependentNavigationProperty->getRelationship() != $principalNavigationProperty->getRelationship()) {
                throw new \Exception("if you have both a dependant property and a principal property they should both have the same relationship");
            }
            if ($dependentNavigationProperty->getFromRole() != $principalNavigationProperty->getToRole() ||
                $dependentNavigationProperty->getToRole() != $principalNavigationProperty->getFromRole()
            ) {
                throw new \Exception("The from roles and two roles from matching properties should match");
            }
        }
        $namespace = $this->V3Edmx->getDataServices()[0]->getNamespace();

        if (0 == strlen(trim($namespace))) {
            $principalTypeFQName = $principalType->getName();
            $dependentTypeFQName = $dependentType->getName();
        } else {
            $principalTypeFQName = $namespace . "." . $principalType->getName();
            $dependentTypeFQName = $namespace . "." . $dependentType->getName();
        }
        $association = new TAssociationType();
        $association->setName($principalNavigationProperty->getRelationship());
        $principalEnd = new TAssociationEndType();
        $principalEnd->setType($principalTypeFQName);
        $principalEnd->setRole($principalNavigationProperty->getFromRole());
        $principalEnd->setMultiplicity($principalMultiplicity);
        $dependentEnd = new TAssociationEndType();
        $dependentEnd->setType($dependentTypeFQName);
        $dependentEnd->setRole($dependentNavigationProperty->getFromRole());
        $dependentEnd->setMultiplicity($dependentMultiplicity);
        $association->addToEnd($principalEnd);
        $association->addToEnd($dependentEnd);
        $principalReferralConstraint = null;
        $dependentReferralConstraint = null;
        if (null != $principalConstraintProperty && 0 < count($principalConstraintProperty)) {
            $principalReferralConstraint = new TReferentialConstraintRoleElementType();
            $principalReferralConstraint->setRole($principalNavigationProperty->getFromRole());
            foreach ($principalConstraintProperty as $propertyRef) {
                $principalReferralConstraint->addToPropertyRef($propertyRef);
            }
        }
        if (null != $dependentConstraintProperty && 0 < count($dependentConstraintProperty)) {
            $dependentReferralConstraint = new TReferentialConstraintRoleElementType();
            $dependentReferralConstraint->setRole($dependentNavigationProperty->getFromRole());
            foreach ($dependentConstraintProperty as $propertyRef) {
                $dependentReferralConstraint->addToPropertyRef($propertyRef);
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

    protected function createAssocationSetForAssocation(
        TAssociationType $association,
        $principalEntitySetName,
        $dependentEntitySetName
    ) {
        $as = new AssociationSetAnonymousType();
        $name = $association->getName();
        $as->setName($name);
        $namespace = $this->V3Edmx->getDataServices()[0]->getNamespace();
        if (0 == strlen(trim($namespace))) {
            $associationSetName = $association->getName();
        } else {
            $associationSetName = $namespace . "." . $association->getName();
        }
        $as->setAssociation($associationSetName);
        $end1 = new EndAnonymousType();
        $end1->setRole($association->getEnd()[0]->getRole());
        $end1->setEntitySet($principalEntitySetName);
        $end2 = new EndAnonymousType();
        $end2->setRole($association->getEnd()[1]->getRole());
        $end2->setEntitySet($dependentEntitySetName);
        $as->addToEnd($end1);
        $as->addToEnd($end2);
        return $as;
    }
}
