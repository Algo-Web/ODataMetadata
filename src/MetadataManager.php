<?php

namespace AlgoWeb\ODataMetadata;

use AlgoWeb\ODataMetadata\MetadataV3\edm\EntityContainer\AssociationSetAnonymousType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\EntityContainer\AssociationSetAnonymousType\EndAnonymousType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\EntityContainer\EntitySetAnonymousType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\EntityContainer\FunctionImportAnonymousType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TAssociationEndType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TAssociationType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TComplexTypePropertyType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TComplexTypeType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TConstraintType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TDocumentationType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TEntityPropertyType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TEntityTypeType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionImportReturnTypeType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionReturnTypeType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TNavigationPropertyType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyRefType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TReferentialConstraintRoleElementType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TTextType;
use AlgoWeb\ODataMetadata\MetadataV3\edmx\Edmx;
use Illuminate\Support\Str;
use JMS\Serializer\SerializerBuilder;

class MetadataManager
{
    private $V3Edmx = null;
    private $lastError = null;
    private $serializer = null;

    public function __construct($namespaceName = "Data", $containerName = "DefaultContainer")
    {
        $this->V3Edmx = new Edmx($namespaceName, $containerName);
        if (!$this->V3Edmx->isOK($msg)) {
            throw new \Exception($msg);
        }
        $this->initSerialiser();
        assert(null != $this->serializer, "Serializer must not be null at end of constructor");
    }

    public function getEdmx()
    {
        $msg = null;
        assert($this->V3Edmx->isOk($msg), $msg);
        return $this->V3Edmx;
    }

    public function getEdmxXML()
    {
        assert(null != $this->serializer, "Serializer must not be null when trying to get edmx xml");
        return $this->serializer->serialize($this->getEdmx(), "xml");
    }

    public function addEntityType($name, $accessType = "Public", $summary = null, $longDescription = null)
    {
        $NewEntity = new TEntityTypeType();
        $NewEntity->setName($name);
        if (null != $summary || null != $longDescription) {
            $documentation = $this->generateDocumentation($summary, $longDescription);
            $NewEntity->setDocumentation($documentation);
        }

        $entitySet = new EntitySetAnonymousType();
        $entitySet->setName(Str::plural($NewEntity->getName(), 2));
        $namespace = $this->V3Edmx->getDataServiceType()->getSchema()[0]->getNamespace();
        if (0 == strlen(trim($namespace))) {
            $entityTypeName = $NewEntity->getName();
        } else {
            $entityTypeName = $namespace . "." . $NewEntity->getName();
        }
        $entitySet->setEntityType($entityTypeName);
        $entitySet->setGetterAccess($accessType);

        $this->V3Edmx->getDataServiceType()->getSchema()[0]->addToEntityType($NewEntity);
        $this->V3Edmx->getDataServiceType()->getSchema()[0]->getEntityContainer()[0]->addToEntitySet($entitySet);
        if (!$this->V3Edmx->isok($this->lastError)) {
            return false;
        }
        return [$NewEntity, $entitySet];
    }

    public function addComplexType($name, $accessType = "Public", $summary = null, $longDescription = null)
    {
        $NewEntity = new TComplexTypeType();
        $NewEntity->setName($name);
        $NewEntity->setTypeAccess($accessType);
        if (null != $summary || null != $longDescription) {
            $documentation = new TDocumentationType();
            $documentation->setSummary($summary);
            $documentation->setLongDescription($longDescription);
            $NewEntity->setDocumentation($documentation);
        }
        $this->V3Edmx->getDataServiceType()->getSchema()[0]->addToComplexType($NewEntity);

        return $NewEntity;
    }

    public function getSerialiser()
    {
        return $this->serializer;
    }

    public function addPropertyToComplexType(
        \AlgoWeb\ODataMetadata\MetadataV3\edm\TComplexTypeType $complexType,
        $name,
        $type,
        $defaultValue = null,
        $nullable = false,
        $summary = null,
        $longDescription = null
    ) {
        $NewProperty = new TComplexTypePropertyType();
        $NewProperty->setName($name);
        $NewProperty->setType($type);
        $NewProperty->setNullable($nullable);
        if (null != $summary || null != $longDescription) {
            $documentation = $this->generateDocumentation($summary, $longDescription);
            $NewProperty->addToDocumentation($documentation);
        }
        if (null != $defaultValue) {
            $NewProperty->setDefaultValue($defaultValue);
        }
        $complexType->addToProperty($NewProperty);
        return $NewProperty;
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
            return false;
        }
        return $NewProperty;
    }

    public function addNavigationPropertyToEntityType(
        TEntityTypeType $principalType,
        $principalMultiplicity,
        $principalProperty,
        TEntityTypeType $dependentType,
        $dependentMultiplicity,
        $dependentProperty = "",
        array $principalConstraintProperty = null,
        array $dependentConstraintProperty = null,
        $principalGetterAccess = "Public",
        $principalSetterAccess = "Public",
        $dependentGetterAccess = "Public",
        $dependentSetterAccess = "Public",
        $principalSummery = null,
        $principalLongDescription = null,
        $dependentSummery = null,
        $dependentLongDescription = null
    ) {
        $principalEntitySetName = Str::plural($principalType->getName(), 2);
        $dependentEntitySetName = Str::plural($dependentType->getName(), 2);
        $relationName = $principalType->getName() . "_" . $principalProperty . "_"
                        . $dependentType->getName() . "_" . $dependentProperty;
        $relationName = trim($relationName, "_");

        $namespace = $this->V3Edmx->getDataServiceType()->getSchema()[0]->getNamespace();
        if (0 == strlen(trim($namespace))) {
            $relationFQName = $relationName;
        } else {
            $relationFQName = $namespace . "." . $relationName;
        }

        $principalNavigationProperty = new TNavigationPropertyType();
        $principalNavigationProperty->setName($principalProperty);
        $principalNavigationProperty->setToRole(trim($dependentEntitySetName . "_" . $dependentProperty, "_"));
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
        $dependentNavigationProperty = null;
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

        $assocation = $this->createAssocationFromNavigationProperty(
            $principalType,
            $dependentType,
            $principalNavigationProperty,
            $dependentNavigationProperty,
            $principalMultiplicity,
            $dependentMultiplicity,
            $principalConstraintProperty,
            $dependentConstraintProperty
        );

        $this->V3Edmx->getDataServiceType()->getSchema()[0]->addToAssociation($assocation);

        $associationSet = $this->createAssocationSetForAssocation(
            $assocation,
            $principalEntitySetName,
            $dependentEntitySetName
        );

        $this->V3Edmx->getDataServiceType()->getSchema()[0]
            ->getEntityContainer()[0]->addToAssociationSet($associationSet);

        if (!$this->V3Edmx->isok($this->lastError)) {
            return false;
        }
        return [$principalNavigationProperty, $dependentNavigationProperty];
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
                $msg = "if you have both a dependent property and a principal property,"
                       ." they should both have the same relationship";
                throw new \Exception($msg);
            }
            if ($dependentNavigationProperty->getFromRole() != $principalNavigationProperty->getToRole() ||
                $dependentNavigationProperty->getToRole() != $principalNavigationProperty->getFromRole()
            ) {
                throw new \Exception("The from roles and two roles from matching properties should match");
            }
        }
        $namespace = $this->V3Edmx->getDataServiceType()->getSchema()[0]->getNamespace();

        if (0 == strlen(trim($namespace))) {
            $principalTypeFQName = $principalType->getName();
            $dependentTypeFQName = $dependentType->getName();
        } else {
            $principalTypeFQName = $namespace . "." . $principalType->getName();
            $dependentTypeFQName = $namespace . "." . $dependentType->getName();
        }
        $association = new TAssociationType();
        $relationship = $principalNavigationProperty->getRelationship();
        if (strpos($relationship, '.') !== false) {
            $relationship = substr($relationship, strpos($relationship, '.') + 1);
        }

        $association->setName($relationship);
        $principalEnd = new TAssociationEndType();
        $principalEnd->setType($principalTypeFQName);
        $principalEnd->setRole($principalNavigationProperty->getFromRole());
        $principalEnd->setMultiplicity($principalMultiplicity);
        $association->addToEnd($principalEnd);
        $dependentEnd = new TAssociationEndType();
        $dependentEnd->setType($dependentTypeFQName);
        $dependentEnd->setMultiplicity($dependentMultiplicity);
        $association->addToEnd($dependentEnd);

        if (null != $dependentNavigationProperty) {
            $dependentEnd->setRole($dependentNavigationProperty->getFromRole());
        } else {
            $dependentEnd->setRole($principalNavigationProperty->getToRole());
        }

        $principalReferralConstraint = null;
        $dependentReferralConstraint = null;

        if (null != $principalConstraintProperty && 0 < count($principalConstraintProperty)) {
            $principalReferralConstraint = new TReferentialConstraintRoleElementType();
            $principalReferralConstraint->setRole($principalNavigationProperty->getFromRole());
            foreach ($principalConstraintProperty as $propertyRef) {
                $TpropertyRef = new TPropertyRefType();
                $TpropertyRef->setName($propertyRef);
                $principalReferralConstraint->addToPropertyRef($TpropertyRef);
            }
        }
        if (null != $dependentConstraintProperty && 0 < count($dependentConstraintProperty)) {
            $dependentReferralConstraint = new TReferentialConstraintRoleElementType();
            $dependentReferralConstraint->setRole($dependentNavigationProperty->getFromRole());
            foreach ($dependentConstraintProperty as $propertyRef) {
                $TpropertyRef = new TPropertyRefType();
                $TpropertyRef->setName($propertyRef);
                $dependentReferralConstraint->addToPropertyRef($TpropertyRef);
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
        $namespace = $this->V3Edmx->getDataServiceType()->getSchema()[0]->getNamespace();
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

    public function getLastError()
    {
        return $this->lastError;
    }

    /**
     * @param string $name
     * @param IsOK $expectedReturnType
     * @param TTextType $shortDesc
     * @param TTextType $longDesc
     * @return FunctionImportAnonymousType
     */
    public function createSingleton(
        $name,
        IsOK $expectedReturnType,
        TTextType $shortDesc = null,
        TTextType $longDesc = null
    ) {
        if (!($expectedReturnType instanceof TEntityTypeType) && !($expectedReturnType instanceof TComplexTypeType)) {
            $msg = "Expected return type must be either TEntityType or TComplexType";
            throw new \InvalidArgumentException($msg);
        }

        if (!is_string($name) || empty($name)) {
            $msg = "Name must be a non-empty string";
            throw new \InvalidArgumentException($msg);
        }

        $documentation = null;
        if (null != $shortDesc || null != $longDesc) {
            $documentation = $this->generateDocumentation($shortDesc, $longDesc);
        }
        $funcType = new FunctionImportAnonymousType();
        $funcType->setName($name);

        $typeName = $expectedReturnType->getName();
        $returnType = new TFunctionImportReturnTypeType();
        $returnType->setType($typeName);
        $returnType->setEntitySetAttribute($typeName);
        assert($returnType->isOK($msg), $msg);
        $funcType->addToReturnType($returnType);
        if (null != $documentation) {
            $funcType->setDocumentation($documentation);
        }

        $this->getEdmx()->getDataServiceType()->getSchema()[0]->getEntityContainer()[0]->addToFunctionImport($funcType);

        return $funcType;
    }

    private function initSerialiser()
    {
        $ymlDir = __DIR__ . DIRECTORY_SEPARATOR . "MetadataV3" . DIRECTORY_SEPARATOR . "JMSmetadata";
        $this->serializer =
            SerializerBuilder::create()
                ->addMetadataDir($ymlDir)
                ->build();
    }

    public function __sleep()
    {
        $this->serializer = null;
        $result = array_keys(get_object_vars($this));
        return $result;
    }

    public function __wakeup()
    {
        $this->initSerialiser();
    }

    /**
     * @param $summary
     * @param $longDescription
     * @return TDocumentationType
     */
    private function generateDocumentation($summary, $longDescription)
    {
        $documentation = new TDocumentationType();
        $documentation->setSummary($summary);
        $documentation->setLongDescription($longDescription);
        return $documentation;
    }
}
