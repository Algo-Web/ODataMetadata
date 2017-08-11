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
    private $v3Edmx = null;
    private $lastError = null;
    private $serializer = null;

    public function __construct($namespaceName = 'Data', $containerName = 'DefaultContainer', Edmx $edmx = null)
    {
        $msg = null;
        $this->v3Edmx = (null == $edmx) ? new Edmx($namespaceName, $containerName) : $edmx;
        assert($this->v3Edmx->isOK($msg), $msg);
        $this->initSerialiser();
        assert(null != $this->serializer, 'Serializer must not be null at end of constructor');
    }

    public function getEdmx()
    {
        $msg = null;
        assert($this->v3Edmx->isOK($msg), $msg);
        return $this->v3Edmx;
    }

    /**
     * @return \JMS\Serializer\Serializer
     */
    public function getEdmxXML()
    {
        $cereal = $this->getSerialiser();
        assert(null != $cereal, 'Serializer must not be null when trying to get edmx xml');
        return $cereal->serialize($this->getEdmx(), 'xml');
    }

    /**
     * @param  string               $name
     * @param  TEntityTypeType|null $baseType
     * @param  bool                 $isAbstract
     * @param  string               $accessType
     * @param  null                 $summary
     * @param  null                 $longDescription
     * @return IsOK[]
     */
    public function addEntityType(
        $name,
        TEntityTypeType $baseType = null,
        $isAbstract = false,
        $accessType = 'Public',
        $summary = null,
        $longDescription = null
    ) {
        $newEntity = new TEntityTypeType();
        $newEntity->setName($name);
        $this->addDocumentation($summary, $longDescription, $newEntity);
        $newEntity->setAbstract($isAbstract);
        $newEntity->setBaseType(null === $baseType ? null:$this->getNamespace() . $baseType->getName());

        $entitySet = new EntitySetAnonymousType();
        $entitySet->setName(Str::plural($newEntity->getName()));
        $namespace = $this->getNamespace();
        $entityTypeName = $namespace . $newEntity->getName();
        $entitySet->setEntityType($entityTypeName);
        $entitySet->setGetterAccess($accessType);

        $this->v3Edmx->getDataServiceType()->getSchema()[0]->addToEntityType($newEntity);
        $this->v3Edmx->getDataServiceType()->getSchema()[0]->getEntityContainer()[0]->addToEntitySet($entitySet);
        assert($this->v3Edmx->isOK($this->lastError), $this->lastError);
        return [$newEntity, $entitySet];
    }

    public function addComplexType($name, $accessType = 'Public', $summary = null, $longDescription = null)
    {
        $newEntity = new TComplexTypeType();
        $newEntity->setName($name);
        $newEntity->setTypeAccess($accessType);
        $this->addDocumentation($summary, $longDescription, $newEntity);
        assert($newEntity->isOK($this->lastError), $this->lastError);
        $this->v3Edmx->getDataServiceType()->getSchema()[0]->addToComplexType($newEntity);

        return $newEntity;
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
            throw new \InvalidArgumentException('Default value cannot be object or array');
        }
        if (null != $defaultValue) {
            $defaultValue = var_export($defaultValue, true);
        }
        $newProperty = new TComplexTypePropertyType();
        $newProperty->setName($name);
        $newProperty->setType($type);
        $newProperty->setNullable($nullable);
        $this->addDocumentation($summary, $longDescription, $newProperty);
        if (null != $defaultValue) {
            $newProperty->setDefaultValue($defaultValue);
        }
        assert($newProperty->isOK($this->lastError), $this->lastError);
        $complexType->addToProperty($newProperty);
        return $newProperty;
    }

    /**
     * @param TEntityTypeType $entityType
     * @param $name
     * @param $type
     * @param  null                $defaultValue
     * @param  bool                $nullable
     * @param  bool                $isKey
     * @param  null                $storeGeneratedPattern
     * @param  null                $summary
     * @param  null                $longDescription
     * @return TEntityPropertyType
     */
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
        $newProperty = new TEntityPropertyType();
        $newProperty->setName($name);
        $newProperty->setType($type);
        $newProperty->setStoreGeneratedPattern($storeGeneratedPattern);
        $newProperty->setNullable($nullable);
        $this->addDocumentation($summary, $longDescription, $newProperty);
        if (null != $defaultValue) {
            $newProperty->setDefaultValue($defaultValue);
        }
        $entityType->addToProperty($newProperty);
        if ($isKey) {
            $key = new TPropertyRefType();
            $key->setName($name);
            $entityType->addToKey($key);
        }
        return $newProperty;
    }

    /**
     * @param TEntityTypeType $principalType
     * @param  $principalMultiplicity
     * @param  $principalProperty
     * @param TEntityTypeType $dependentType
     * @param  $dependentMultiplicity
     * @param  string           $dependentProperty
     * @param  array|null       $principalConstraintProperty
     * @param  array|null       $dependentConstraintProperty
     * @param  string           $principalGetterAccess
     * @param  string           $principalSetterAccess
     * @param  string           $dependentGetterAccess
     * @param  string           $dependentSetterAccess
     * @param  null             $principalSummery
     * @param  null             $principalLongDescription
     * @param  null             $dependentSummery
     * @param  null             $dependentLongDescription
     * @return array<IsOK|null>
     */
    public function addNavigationPropertyToEntityType(
        TEntityTypeType $principalType,
        $principalMultiplicity,
        $principalProperty,
        TEntityTypeType $dependentType,
        $dependentMultiplicity,
        $dependentProperty = '',
        array $principalConstraintProperty = null,
        array $dependentConstraintProperty = null,
        $principalGetterAccess = 'Public',
        $principalSetterAccess = 'Public',
        $dependentGetterAccess = 'Public',
        $dependentSetterAccess = 'Public',
        $principalSummery = null,
        $principalLongDescription = null,
        $dependentSummery = null,
        $dependentLongDescription = null
    ) {
        $principalEntitySetName = Str::plural($principalType->getName());
        $dependentEntitySetName = Str::plural($dependentType->getName());
        $relationName = $principalType->getName() . '_' . $principalProperty . '_'
                        . $dependentType->getName() . '_' . $dependentProperty;
        $relationName = trim($relationName, '_');

        $namespace = $this->getNamespace();
        $relationFQName = $namespace . $relationName;

        $principalNavigationProperty = new TNavigationPropertyType();
        $principalNavigationProperty->setName($principalProperty);
        $principalNavigationProperty->setToRole(trim($dependentEntitySetName . '_' . $dependentProperty, '_'));
        $principalNavigationProperty->setFromRole($principalEntitySetName . '_' . $principalProperty);
        $principalNavigationProperty->setRelationship($relationFQName);
        $principalNavigationProperty->setGetterAccess($principalGetterAccess);
        $principalNavigationProperty->setSetterAccess($principalSetterAccess);
        $this->addDocumentation($principalSummery, $principalLongDescription, $principalNavigationProperty);
        $principalType->addToNavigationProperty($principalNavigationProperty);
        $dependentNavigationProperty = null;
        if (!empty($dependentProperty)) {
            $dependentNavigationProperty = new TNavigationPropertyType();
            $dependentNavigationProperty->setName($dependentProperty);
            $dependentNavigationProperty->setToRole($principalEntitySetName . '_' . $principalProperty);
            $dependentNavigationProperty->setFromRole($dependentEntitySetName . '_' . $dependentProperty);
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

        $this->v3Edmx->getDataServiceType()->getSchema()[0]->addToAssociation($assocation);

        $associationSet = $this->createAssocationSetForAssocation(
            $assocation,
            $principalEntitySetName,
            $dependentEntitySetName
        );

        $this->v3Edmx->getDataServiceType()->getSchema()[0]
            ->getEntityContainer()[0]->addToAssociationSet($associationSet);

        assert($this->v3Edmx->isOK($this->lastError), $this->lastError);
        return [$principalNavigationProperty, $dependentNavigationProperty];
    }

    /**
     * @param TEntityTypeType              $principalType
     * @param TEntityTypeType              $dependentType
     * @param TNavigationPropertyType      $principalNavigationProperty
     * @param TNavigationPropertyType|null $dependentNavigationProperty
     * @param $principalMultiplicity
     * @param $dependentMultiplicity
     * @param  array|null       $principalConstraintProperty
     * @param  array|null       $dependentConstraintProperty
     * @return TAssociationType
     */
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
        $multCombo = ['*' => ['*', '1', '0..1'], '0..1' => ['1', '*'], '1' => ['*', '0..1']];
        $multKeys = array_keys($multCombo);
        if (null != $dependentNavigationProperty) {
            if ($dependentNavigationProperty->getRelationship() != $principalNavigationProperty->getRelationship()) {
                $msg = 'If you have both a dependent property and a principal property,'
                       .' relationship should match';
                throw new \InvalidArgumentException($msg);
            }
            if ($dependentNavigationProperty->getFromRole() != $principalNavigationProperty->getToRole()
                || $dependentNavigationProperty->getToRole() != $principalNavigationProperty->getFromRole()
            ) {
                throw new \InvalidArgumentException(
                    'Principal to role should match dependent from role, and vice versa'
                );
            }
        }
        if (!in_array($principalMultiplicity, $multKeys) || !in_array($dependentMultiplicity, $multKeys)) {
            throw new \InvalidArgumentException('Malformed multiplicity - valid values are *, 0..1 and 1');
        }
        if (!in_array($dependentMultiplicity, $multCombo[$principalMultiplicity])) {
            throw new \InvalidArgumentException(
                'Invalid multiplicity combination - ' . $principalMultiplicity . ' ' . $dependentMultiplicity
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
                $principalConstraintProperty,
                $principalTargRole
            );
            $dependentReferralConstraint = $this->makeReferentialConstraint(
                $dependentConstraintProperty,
                $dependentTargRole
            );
            $constraint = new TConstraintType();
            $constraint->setPrincipal($principalReferralConstraint);
            $constraint->setDependent($dependentReferralConstraint);
            $association->setReferentialConstraint($constraint);
        }
        return $association;
    }

    /**
     * @param  TAssociationType            $association
     * @param  string                      $principalEntitySetName
     * @param  string                      $dependentEntitySetName
     * @return AssociationSetAnonymousType
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

    /**
     * @return string|null
     */
    public function getLastError()
    {
        return $this->lastError;
    }

    /**
     * @param  string                      $name
     * @param  IsOK                        $expectedReturnType
     * @param  EntitySetAnonymousType|null $entitySet
     * @param  TTextType|null              $shortDesc
     * @param  TTextType|null              $longDesc
     * @return FunctionImportAnonymousType
     */
    public function createSingleton(
        $name,
        IsOK $expectedReturnType,
        EntitySetAnonymousType $entitySet = null,
        TTextType $shortDesc = null,
        TTextType $longDesc = null
    ) {
        if (!($expectedReturnType instanceof TEntityTypeType) && !($expectedReturnType instanceof TComplexTypeType)) {
            $msg = 'Expected return type must be either TEntityType or TComplexType';
            throw new \InvalidArgumentException($msg);
        }

        if (!is_string($name) || empty($name)) {
            $msg = 'Name must be a non-empty string';
            throw new \InvalidArgumentException($msg);
        }

        $funcType = new FunctionImportAnonymousType();
        $funcType->setName($name);

        $namespace = $this->getNamespace();
        $typeName = $expectedReturnType->getName();
        $fqTypeName = $namespace.$typeName;
        $fqSetName = ($entitySet == null) ? $typeName : $entitySet->getName();

        $returnType = new TFunctionImportReturnTypeType();
        $returnType->setType($fqTypeName);
        $returnType->setEntitySetAttribute($fqSetName);
        assert($returnType->isOK($msg), $msg);
        $funcType->addToReturnType($returnType);
        $this->addDocumentation($shortDesc, $longDesc, $funcType);

        $this->getEdmx()->getDataServiceType()->getSchema()[0]->getEntityContainer()[0]->addToFunctionImport($funcType);

        return $funcType;
    }

    private function initSerialiser()
    {
        $ymlDir = __DIR__ . DIRECTORY_SEPARATOR . 'MetadataV3' . DIRECTORY_SEPARATOR . 'JMSmetadata';
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
    protected function getNamespace()
    {
        $namespace = $this->v3Edmx->getDataServiceType()->getSchema()[0]->getNamespace();
        if (0 == strlen(trim($namespace))) {
            $namespace = '';
        } else {
            $namespace .= '.';
        }
        return $namespace;
    }

    /**
     * @param  array                                 $constraintProperty
     * @param  string                                $targRole
     * @return TReferentialConstraintRoleElementType
     */
    protected function makeReferentialConstraint(array $constraintProperty, $targRole)
    {
        assert(!empty($constraintProperty));
        assert(is_string($targRole));
        $referralConstraint = new TReferentialConstraintRoleElementType();
        $referralConstraint->setRole($targRole);
        foreach ($constraintProperty as $propertyRef) {
            $tPropertyRef = new TPropertyRefType();
            $tPropertyRef->setName($propertyRef);
            $referralConstraint->addToPropertyRef($tPropertyRef);
        }
        return $referralConstraint;
    }

    /**
     * @param $summary
     * @param $longDescription
     * @param $newEntity
     */
    private function addDocumentation($summary, $longDescription, IsOK & $newEntity)
    {
        if (null != $summary && null != $longDescription) {
            $documentation = $this->generateDocumentation($summary, $longDescription);
            if (method_exists($newEntity, 'addToDocumentation')) {
                $newEntity->addToDocumentation($documentation);
            } else {
                $newEntity->setDocumentation($documentation);
            }
        }
    }
}
