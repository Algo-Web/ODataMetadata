<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\mapping\cs;

use AlgoWeb\ODataMetadata\IsOK;

/**
 * Class representing TMappingFragmentType
 *
 * Type for MappingFragment element
 *
 * XSD Type: TMappingFragment
 */
class TMappingFragmentType extends IsOK
{

    /**
     * @property string $storeEntitySet
     */
    private $storeEntitySet = null;

    /**
     * @property boolean $makeColumnsDistinct
     */
    private $makeColumnsDistinct = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TComplexPropertyType $complexProperty
     */
    private $complexProperty = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TScalarPropertyType $scalarProperty
     */
    private $scalarProperty = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TConditionType $condition
     */
    private $condition = null;

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
     * @param string $storeEntitySet
     * @return self
     */
    public function setStoreEntitySet($storeEntitySet)
    {
        $this->storeEntitySet = $storeEntitySet;
        return $this;
    }

    /**
     * Gets as makeColumnsDistinct
     *
     * @return boolean
     */
    public function getMakeColumnsDistinct()
    {
        return $this->makeColumnsDistinct;
    }

    /**
     * Sets a new makeColumnsDistinct
     *
     * @param boolean $makeColumnsDistinct
     * @return self
     */
    public function setMakeColumnsDistinct($makeColumnsDistinct)
    {
        $this->makeColumnsDistinct = $makeColumnsDistinct;
        return $this;
    }

    /**
     * Gets as complexProperty
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TComplexPropertyType
     */
    public function getComplexProperty()
    {
        return $this->complexProperty;
    }

    /**
     * Sets a new complexProperty
     *
     * @param \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TComplexPropertyType $complexProperty
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
     * @return \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TScalarPropertyType
     */
    public function getScalarProperty()
    {
        return $this->scalarProperty;
    }

    /**
     * Sets a new scalarProperty
     *
     * @param \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TScalarPropertyType $scalarProperty
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
     * @return \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TConditionType
     */
    public function getCondition()
    {
        return $this->condition;
    }

    /**
     * Sets a new condition
     *
     * @param \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TConditionType $condition
     * @return self
     */
    public function setCondition(TConditionType $condition)
    {
        $this->condition = $condition;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (!$this->isStringNotNullOrEmpty($this->storeEntitySet)) {
            $msg = 'Name cannot be null or empty';
            return false;
        }
        if (null != $this->scalarProperty && !$this->scalarProperty->isOK($msg)) {
            return false;
        }
        if (null != $this->complexProperty && !$this->complexProperty->isOK($msg)) {
            return false;
        }
        if (null != $this->condition && !$this->condition->isOK($msg)) {
            return false;
        }
        return true;
    }
}
