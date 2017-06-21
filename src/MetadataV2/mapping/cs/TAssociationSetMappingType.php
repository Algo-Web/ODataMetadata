<?php

namespace AlgoWeb\ODataMetadata\MetadataV2\mapping\cs;

use AlgoWeb\ODataMetadata\IsOK;

/**
 * Class representing TAssociationSetMappingType
 *
 * XSD Type: TAssociationSetMapping
 */
class TAssociationSetMappingType extends IsOK
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
     * @property string $queryView
     */
    private $queryView = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV2\mapping\cs\TEndPropertyType[] $endProperty
     */
    private $endProperty = array();

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV2\mapping\cs\TConditionType[] $condition
     */
    private $condition = array();

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV2\mapping\cs\TAssociationSetModificationFunctionMappingType
     * $modificationFunctionMapping
     */
    private $modificationFunctionMapping = null;

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
     * Gets as queryView
     *
     * @return string
     */
    public function getQueryView()
    {
        return $this->queryView;
    }

    /**
     * Sets a new queryView
     *
     * @param  string $queryView
     * @return self
     */
    public function setQueryView($queryView)
    {
        $this->queryView = $queryView;
        return $this;
    }

    /**
     * Adds as endProperty
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV2\mapping\cs\TEndPropertyType $endProperty
     */
    public function addToEndProperty(TEndPropertyType $endProperty)
    {
        $this->endProperty[] = $endProperty;
        return $this;
    }

    /**
     * isset endProperty
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetEndProperty($index)
    {
        return isset($this->endProperty[$index]);
    }

    /**
     * unset endProperty
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetEndProperty($index)
    {
        unset($this->endProperty[$index]);
    }

    /**
     * Gets as endProperty
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV2\mapping\cs\TEndPropertyType[]
     */
    public function getEndProperty()
    {
        return $this->endProperty;
    }

    /**
     * Sets a new endProperty
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV2\mapping\cs\TEndPropertyType[] $endProperty
     * @return self
     */
    public function setEndProperty(array $endProperty)
    {
        $this->endProperty = $endProperty;
        return $this;
    }

    /**
     * Adds as condition
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV2\mapping\cs\TConditionType $condition
     */
    public function addToCondition(TConditionType $condition)
    {
        $this->condition[] = $condition;
        return $this;
    }

    /**
     * isset condition
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetCondition($index)
    {
        return isset($this->condition[$index]);
    }

    /**
     * unset condition
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetCondition($index)
    {
        unset($this->condition[$index]);
    }

    /**
     * Gets as condition
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV2\mapping\cs\TConditionType[]
     */
    public function getCondition()
    {
        return $this->condition;
    }

    /**
     * Sets a new condition
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV2\mapping\cs\TConditionType[] $condition
     * @return self
     */
    public function setCondition(array $condition)
    {
        $this->condition = $condition;
        return $this;
    }

    /**
     * Gets as modificationFunctionMapping
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV2\mapping\cs\TAssociationSetModificationFunctionMappingType
     */
    public function getModificationFunctionMapping()
    {
        return $this->modificationFunctionMapping;
    }

    /**
     * Sets a new modificationFunctionMapping
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV2\mapping\cs\TAssociationSetModificationFunctionMappingType
     * $modificationFunctionMapping
     * @return self
     */
    public function setModificationFunctionMapping(TAssociationSetModificationFunctionMappingType $modificationFunctionMapping)
    {
        $this->modificationFunctionMapping = $modificationFunctionMapping;
        return $this;
    }
}
