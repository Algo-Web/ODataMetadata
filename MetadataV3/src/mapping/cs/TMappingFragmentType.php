<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\mapping\cs;

/**
 * Class representing TMappingFragmentType
 *
 *
 * XSD Type: TMappingFragment
 */
class TMappingFragmentType
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
     * @property \MetadataV3\mapping\cs\TComplexPropertyType $complexProperty
     */
    private $complexProperty = null;

    /**
     * @property \MetadataV3\mapping\cs\TScalarPropertyType $scalarProperty
     */
    private $scalarProperty = null;

    /**
     * @property \MetadataV3\mapping\cs\TConditionType $condition
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
     * @return \MetadataV3\mapping\cs\TComplexPropertyType
     */
    public function getComplexProperty()
    {
        return $this->complexProperty;
    }

    /**
     * Sets a new complexProperty
     *
     * @param \MetadataV3\mapping\cs\TComplexPropertyType $complexProperty
     * @return self
     */
    public function setComplexProperty(\MetadataV3\mapping\cs\TComplexPropertyType $complexProperty)
    {
        $this->complexProperty = $complexProperty;
        return $this;
    }

    /**
     * Gets as scalarProperty
     *
     * @return \MetadataV3\mapping\cs\TScalarPropertyType
     */
    public function getScalarProperty()
    {
        return $this->scalarProperty;
    }

    /**
     * Sets a new scalarProperty
     *
     * @param \MetadataV3\mapping\cs\TScalarPropertyType $scalarProperty
     * @return self
     */
    public function setScalarProperty(\MetadataV3\mapping\cs\TScalarPropertyType $scalarProperty)
    {
        $this->scalarProperty = $scalarProperty;
        return $this;
    }

    /**
     * Gets as condition
     *
     * @return \MetadataV3\mapping\cs\TConditionType
     */
    public function getCondition()
    {
        return $this->condition;
    }

    /**
     * Sets a new condition
     *
     * @param \MetadataV3\mapping\cs\TConditionType $condition
     * @return self
     */
    public function setCondition(\MetadataV3\mapping\cs\TConditionType $condition)
    {
        $this->condition = $condition;
        return $this;
    }
}
