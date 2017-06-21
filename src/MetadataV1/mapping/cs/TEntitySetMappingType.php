<?php

namespace AlgoWeb\ODataMetadata\MetadataV1\mapping\cs;

use AlgoWeb\ODataMetadata\IsOK;

/**
 * Class representing TEntitySetMappingType
 *
 * XSD Type: TEntitySetMapping
 */
class TEntitySetMappingType extends IsOK
{

    /**
     * @property string $name
     */
    private $name = null;

    /**
     * @property string $typeName
     */
    private $typeName = null;

    /**
     * @property string $storeEntitySet
     */
    private $storeEntitySet = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV1\mapping\cs\TQueryViewType[] $queryView
     */
    private $queryView = array();

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV1\mapping\cs\TEntityTypeMappingType[] $entityTypeMapping
     */
    private $entityTypeMapping = array();

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV1\mapping\cs\TMappingFragmentType[] $mappingFragment
     */
    private $mappingFragment = array();

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV1\mapping\cs\TComplexPropertyType $complexProperty
     */
    private $complexProperty = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV1\mapping\cs\TScalarPropertyType $scalarProperty
     */
    private $scalarProperty = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV1\mapping\cs\TConditionType $condition
     */
    private $condition = null;

    /**
     * Gets as name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets a new name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Gets as typeName
     *
     * @return string
     */
    public function getTypeName()
    {
        return $this->typeName;
    }

    /**
     * Sets a new typeName
     *
     * @param  string $typeName
     * @return self
     */
    public function setTypeName($typeName)
    {
        $this->typeName = $typeName;
        return $this;
    }

    /**
     * Gets as storeEntitySet
     *
     * @return string
     */
    public function getStoreEntitySet()
    {
        return $this->storeEntitySet;
    }

    /**
     * Sets a new storeEntitySet
     *
     * @param  string $storeEntitySet
     * @return self
     */
    public function setStoreEntitySet($storeEntitySet)
    {
        $this->storeEntitySet = $storeEntitySet;
        return $this;
    }

    /**
     * Adds as queryView
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV1\mapping\cs\TQueryViewType $queryView
     */
    public function addToQueryView(TQueryViewType $queryView)
    {
        $this->queryView[] = $queryView;
        return $this;
    }

    /**
     * isset queryView
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetQueryView($index)
    {
        return isset($this->queryView[$index]);
    }

    /**
     * unset queryView
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetQueryView($index)
    {
        unset($this->queryView[$index]);
    }

    /**
     * Gets as queryView
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV1\mapping\cs\TQueryViewType[]
     */
    public function getQueryView()
    {
        return $this->queryView;
    }

    /**
     * Sets a new queryView
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV1\mapping\cs\TQueryViewType[] $queryView
     * @return self
     */
    public function setQueryView(array $queryView)
    {
        $this->queryView = $queryView;
        return $this;
    }

    /**
     * Adds as entityTypeMapping
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV1\mapping\cs\TEntityTypeMappingType $entityTypeMapping
     */
    public function addToEntityTypeMapping(TEntityTypeMappingType $entityTypeMapping)
    {
        $this->entityTypeMapping[] = $entityTypeMapping;
        return $this;
    }

    /**
     * isset entityTypeMapping
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetEntityTypeMapping($index)
    {
        return isset($this->entityTypeMapping[$index]);
    }

    /**
     * unset entityTypeMapping
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetEntityTypeMapping($index)
    {
        unset($this->entityTypeMapping[$index]);
    }

    /**
     * Gets as entityTypeMapping
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV1\mapping\cs\TEntityTypeMappingType[]
     */
    public function getEntityTypeMapping()
    {
        return $this->entityTypeMapping;
    }

    /**
     * Sets a new entityTypeMapping
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV1\mapping\cs\TEntityTypeMappingType[] $entityTypeMapping
     * @return self
     */
    public function setEntityTypeMapping(array $entityTypeMapping)
    {
        $this->entityTypeMapping = $entityTypeMapping;
        return $this;
    }

    /**
     * Adds as mappingFragment
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV1\mapping\cs\TMappingFragmentType $mappingFragment
     */
    public function addToMappingFragment(TMappingFragmentType $mappingFragment)
    {
        $this->mappingFragment[] = $mappingFragment;
        return $this;
    }

    /**
     * isset mappingFragment
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetMappingFragment($index)
    {
        return isset($this->mappingFragment[$index]);
    }

    /**
     * unset mappingFragment
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetMappingFragment($index)
    {
        unset($this->mappingFragment[$index]);
    }

    /**
     * Gets as mappingFragment
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV1\mapping\cs\TMappingFragmentType[]
     */
    public function getMappingFragment()
    {
        return $this->mappingFragment;
    }

    /**
     * Sets a new mappingFragment
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV1\mapping\cs\TMappingFragmentType[] $mappingFragment
     * @return self
     */
    public function setMappingFragment(array $mappingFragment)
    {
        $this->mappingFragment = $mappingFragment;
        return $this;
    }

    /**
     * Gets as complexProperty
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV1\mapping\cs\TComplexPropertyType
     */
    public function getComplexProperty()
    {
        return $this->complexProperty;
    }

    /**
     * Sets a new complexProperty
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV1\mapping\cs\TComplexPropertyType $complexProperty
     * @return self
     */
    public function setComplexProperty(TComplexPropertyType $complexProperty)
    {
        $this->complexProperty = $complexProperty;
        return $this;
    }

    /**
     * Gets as scalarProperty
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV1\mapping\cs\TScalarPropertyType
     */
    public function getScalarProperty()
    {
        return $this->scalarProperty;
    }

    /**
     * Sets a new scalarProperty
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV1\mapping\cs\TScalarPropertyType $scalarProperty
     * @return self
     */
    public function setScalarProperty(TScalarPropertyType $scalarProperty)
    {
        $this->scalarProperty = $scalarProperty;
        return $this;
    }

    /**
     * Gets as condition
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV1\mapping\cs\TConditionType
     */
    public function getCondition()
    {
        return $this->condition;
    }

    /**
     * Sets a new condition
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV1\mapping\cs\TConditionType $condition
     * @return self
     */
    public function setCondition(TConditionType $condition)
    {
        $this->condition = $condition;
        return $this;
    }
}
