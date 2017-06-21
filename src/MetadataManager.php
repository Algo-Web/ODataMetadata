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

    public function __construct($namespaceName = "Data", $containerName = "DefaultContainer", Edmx $edmx = null)
    {
        $msg = null;
        $this->V3Edmx = (null == $edmx) ? new Edmx($namespaceName, $containerName) : $edmx;
        assert($this->V3Edmx->isOK($msg), $msg);
        $this->initSerialiser();
        assert(null != $this->serializer, "Serializer must not be null at end of constructor");
    }

    public function getEdmx()
    {
        $msg = null;
        assert($this->V3Edmx->isOK($msg), $msg);
        return $this->V3Edmx;
    }

    public function getEdmxXML()
    {
        $cereal = $this->getSerialiser();
        assert(null != $cereal, "Serializer must not be null when trying to get edmx xml");
        return $cereal->serialize($this->getEdmx(), "xml");
    }

    public function addEntityType($name, $accessType = "Public", $summary = null, $longDescription = null)
    {
        $NewEntity = new TEntityTypeType();
        $NewEntity->setName($name);
        $this->addDocumentation($summary, $longDescription, $NewEntity);

        $entitySet = new EntitySetAnonymousType();
        $entitySet->setName(Str::plural($NewEntity->getName()));
        $namespace = $this->getNamespace();
        $entityTypeName = $namespace . $NewEntity->getName();
        $entitySet->setEntityType($entityTypeName);
        $entitySet->setGetterAccess($accessType);

        $this->V3Edmx->getDataServiceType()->getSchema()[0]->addToEntityType($NewEntity);
        $this->V3Edmx->getDataServiceType()->getSchema()[0]->getEntityContainer()[0]->addToEntitySet($entitySet);
        assert($this->V3Edmx->isOK($this->lastError), $this->lastError);
        return [$NewEntity, $entitySet];
    }

    public function addComplexType($name, $accessType = "Public", $summary = null, $longDescription = null)
    {
        $NewEntity = new TComplexTypeType();
        $NewEntity->setName($name);
        $NewEntity->setTypeAccess($accessType);
        $this->addDocumentation($summary, $longDescription, $NewEntity);
        assert($NewEntity->isOK($this->lastError), $this->lastError);
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
        if (is_array($defaultValue) || is_object($defaultValue)) {
            throw new \InvalidArgumentException("Default value cannot be object or array");
        }
        if (null != $defaultValue) {
            $defaultValue = var_export($defaultValue, true);
        }
        $NewProperty = new TComplexTypePropertyType();
        $NewProperty->setName($name);
        $NewProperty->setType($type);
        $NewProperty->setNullable($nullable);
        $this->addDocumentation($summary, $longDescription, $NewProperty);
        if (null != $defaultValue) {
            $NewProperty->setDefaultValue($defaultValue);
        }
        assert($NewProperty->isOK($this->lastError), $this->lastError);
        $complexType->addToProperty($NewProperty);
        return $NewProperty;
    }

    public function addPropertyToEntityType(
        TEntityTypeType $entityType,
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
        $this->addDocumentation($summary, $longDescription, $NewProperty);
        if (null != $defaultValue) {
            $NewProperty->setDefaultValue($defaultValue);
        }
        $entityType->addToProperty($NewProperty);
        if ($isKey) {
            $Key = new TPropertyRefType();
            $Key->setName($name);
            $entityType->addToKey($Key);
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
        $principalEntitySetName = Str::plural($principalType->getName());
        $dependentEntitySetName = Str::plural($dependentType->getName());
        $relationName = $principalType->getName() . "_" . $principalProperty . "_"
                        . $dependentType->getName() . "_" . $dependentProperty;
        $relationName = trim($relationName, "_");

        $namespace = $this->getNamespace();
        $relationFQName = $namespace . $relationName;

        $principalNavigationProperty = new TNavigationPropertyType();
        $principalNavigationProperty->setName($principalProperty);
        $principalNavigationProperty->setToRole(trim($dependentEntitySetName . "_" . $dependentProperty, "_"));
        $principalNavigationProperty->setFromRole($principalEntitySetName . "_" . $principalProperty);
        $principalNavigationProperty->setRelationship($relationFQName);
        $principalNavigationProperty->setGetterAccess($principalGetterAccess);
        $principalNavigationProperty->setSetterAccess($principalSetterAccess);
        $this->addDocumentation($principalSummery, $principalLongDescription, $principalNavigationProperty);
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
            $this->addDocumentation($dependentSummery, $dependentLongDescription, $dependentNavigationProperty);
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

        assert($this->V3Edmx->isOK($this->lastError), $this->lastError);
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
        $multCombo = ['*' => ['*', '1'], '0..1' => ['1'], '1' => ['*', '0..1']];
        $multKeys = array_keys($multCombo);
        if (null != $dependentNavigationProperty) {
            if ($dependentNavigationProperty->getRelationship() != $principalNavigationProperty->getRelationship()) {
                $msg = "If you have both a dependent property and a principal property,"
                        ." relationship should match";
                throw new \InvalidArgumentException($msg);
            }
            if ($dependentNavigationProperty->getFromRole() != $principalNavigationProperty->getToRole()
                || $dependentNavigationProperty->getToRole() != $principalNavigationProperty->getFromRole()
            ) {
                throw new \InvalidArgumentException(
                    "Principal to role should match dependent from role, and vice versa"
                );
            }
        }
        if (!in_array($principalMultiplicity, $multKeys) || !in_array($dependentMultiplicity, $multKeys)) {
            throw new \InvalidArgumentException("Malformed multiplicity - valid values are *, 0..1 and 1");
        }
        if (!in_array($dependentMultiplicity, $multCombo[$principalMultiplicity])) {
            throw new \InvalidArgumentException(
                "Invalid multiplicity combination - " . $principalMultiplicity . ' ' . $dependentMultiplicity
            );
        }

        $namespace = $this->getNamespace();
        $principalTypeFQName = $namespace . $principalType->getName();
        $dependentTypeFQName = $namespace . $dependentType->getName();
        $association = new TAssociationType();
        $relationship = $principalNavigationProperty->getRelationship();
        if (false !== strpos($relationship, '.')) {
            $relationship = substr($relationship, strpos($relationship, '.') + 1);
        }

        $principalTargRole = $principalNavigationProperty->getFromRole();
        $principalSrcRole = $principalNavigationProperty->getToRole();
        $dependentTargRole = null != $dependentNavigationProperty ? $dependentNavigationProperty->getFromRole() : null;

        $association->setName($relationship);
        $principalEnd = new TAssociationEndType();
        $principalEnd->setType($principalTypeFQName);
        $principalEnd->setRole($principalTargRole);
        $principalEnd->setMultiplicity($principalMultiplicity);
        $association->addToEnd($principalEnd);
        $dependentEnd = new TAssociationEndType();
        $dependentEnd->setType($dependentTypeFQName);
        $dependentEnd->setMultiplicity($dependentMultiplicity);
        $association->addToEnd($dependentEnd);

        $dependentEnd->setRole(null != $dependentNavigationProperty ? $dependentTargRole : $principalSrcRole);

        $hasPrincipalReferral = null != $principalConstraintProperty && 0 < count($principalConstraintProperty);
        $hasDependentReferral = null != $dependentConstraintProperty && 0 < count($dependentConstraintProperty);

        if ($hasPrincipalReferral && $hasDependentReferral) {
            $principalReferralConstraint = $this->makeReferentialConstraint(
                $principalConstraintProperty, $principalTargRole
            );
            $dependentReferralConstraint = $this->makeReferentialConstraint(
                $dependentConstraintProperty, $dependentTargRole
            );
            $constraint = new TConstraintType();
            $constraint->setPrincipal($principalReferralConstraint);
            $constraint->setDependent($dependentReferralConstraint);
            $association->setReferentialConstraint($constraint);
        }
        return $association;
    }

    /**
     * @param string $principalEntitySetName
     * @param string $dependentEntitySetName
     */
    protected function createAssocationSetForAssocation(
        TAssociationType $association,
        $principalEntitySetName,
        $dependentEntitySetName
    ) {
        $as = new AssociationSetAnonymousType();
        $name = $association->getName();
        $as->setName($name);
        $namespace = $this->getNamespace();
        $associationSetName = $namespace . $association->getName();
        $as->setAssociation($associationSetName);
        $end1 = new EndAnonymousType();
        $end1->setRole($association->getEnd()[0]->getRole());
        $end1->setEntitySet($principalEntitySetName);
        $end2 = new EndAnonymousType();
        $end2->setRole($association->getEnd()[1]->getRole());
        $end2->setEntitySet($dependentEntitySetName);
        assert($end1->getRole() != $end2->getRole());
        $as->addToEnd($end1);
        $as->addToEnd($end2);
        return $as;
    }

    public function getLastError()
    {
        return $this->lastError;
    }

    /**
     * @param string    $name
     * @param IsOK      $expectedReturnType
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

        $funcType = new FunctionImportAnonymousType();
        $funcType->setName($name);

        $typeName = $expectedReturnType->getName();
        $returnType = new TFunctionImportReturnTypeType();
        $returnType->setType($typeName);
        $returnType->setEntitySetAttribute($typeName);
        assert($returnType->isOK($msg), $msg);
        $funcType->addToReturnType($returnType);
        $this->addDocumentation($shortDesc, $longDesc, $funcType);

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
    private function generateDocumentation(TTextType $summary, TTextType $longDescription)
    {
        $documentation = new TDocumentationType();
        $documentation->setSummary($summary);
        $documentation->setLongDescription($longDescription);
        return $documentation;
    }

    /**
     * @return string
     */
    private function getNamespace()
    {
        $namespace = $this->V3Edmx->getDataServiceType()->getSchema()[0]->getNamespace();
        if (0 == strlen(trim($namespace))) {
            $namespace = "";
        } else {
            $namespace .= ".";
        }
        return $namespace;
    }

    /**
     * @param array  $constraintProperty
     * @param string $targRole
     * @return TReferentialConstraintRoleElementType
     */
    protected function makeReferentialConstraint(array $constraintProperty, $targRole)
    {
        assert(!empty($constraintProperty));
        assert(is_string($targRole));
        $referralConstraint = new TReferentialConstraintRoleElementType();
        $referralConstraint->setRole($targRole);
        foreach ($constraintProperty as $propertyRef) {
            $TpropertyRef = new TPropertyRefType();
            $TpropertyRef->setName($propertyRef);
            $referralConstraint->addToPropertyRef($TpropertyRef);
        }
        return $referralConstraint;
    }

    /**
     * @param $summary
     * @param $longDescription
     * @param $NewEntity
     */
    private function addDocumentation($summary, $longDescription, IsOK & $NewEntity)
    {
        if (null != $summary && null != $longDescription) {
            $documentation = $this->generateDocumentation($summary, $longDescription);
            if (method_exists($NewEntity, 'addToDocumentation')) {
                $NewEntity->addToDocumentation($documentation);
            } else {
                $NewEntity->setDocumentation($documentation);
            }
        }
    }
}
