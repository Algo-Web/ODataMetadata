<?php

namespace MetadataV1\mapping\cs;

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
     * @property \MetadataV1\mapping\cs\TComplexPropertyType $complexProperty
     */
    private $complexProperty = null;

    /**
     * @property \MetadataV1\mapping\cs\TScalarPropertyType $scalarProperty
     */
    private $scalarProperty = null;

    /**
     * @property \MetadataV1\mapping\cs\TConditionType $condition
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
     * Gets as complexProperty
     *
     * @return \MetadataV1\mapping\cs\TComplexPropertyType
     */
    public function getComplexProperty()
    {
        return $this->complexProperty;
    }

    /**
     * Sets a new complexProperty
     *
     * @param \MetadataV1\mapping\cs\TComplexPropertyType $complexProperty
     * @return self
     */
    public function setComplexProperty(\MetadataV1\mapping\cs\TComplexPropertyType $complexProperty)
    {
        $this->complexProperty = $complexProperty;
        return $this;
    }

    /**
     * Gets as scalarProperty
     *
     * @return \MetadataV1\mapping\cs\TScalarPropertyType
     */
    public function getScalarProperty()
    {
        return $this->scalarProperty;
    }

    /**
     * Sets a new scalarProperty
     *
     * @param \MetadataV1\mapping\cs\TScalarPropertyType $scalarProperty
     * @return self
     */
    public function setScalarProperty(\MetadataV1\mapping\cs\TScalarPropertyType $scalarProperty)
    {
        $this->scalarProperty = $scalarProperty;
        return $this;
    }

    /**
     * Gets as condition
     *
     * @return \MetadataV1\mapping\cs\TConditionType
     */
    public function getCondition()
    {
        return $this->condition;
    }

    /**
     * Sets a new condition
     *
     * @param \MetadataV1\mapping\cs\TConditionType $condition
     * @return self
     */
    public function setCondition(\MetadataV1\mapping\cs\TConditionType $condition)
    {
        $this->condition = $condition;
        return $this;
    }
}
