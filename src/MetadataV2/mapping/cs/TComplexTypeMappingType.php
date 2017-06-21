<?php

namespace AlgoWeb\ODataMetadata\MetadataV2\mapping\cs;

use AlgoWeb\ODataMetadata\IsOK;

/**
 * Class representing TComplexTypeMappingType
 *
 * XSD Type: TComplexTypeMapping
 */
class TComplexTypeMappingType extends IsOK
{

    /**
     * @property string $typeName
     */
    private $typeName = null;

    /**
     * @property boolean $isPartial
     */
    private $isPartial = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV2\mapping\cs\TScalarPropertyType[] $scalarProperty
     */
    private $scalarProperty = array();

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV2\mapping\cs\TComplexPropertyType[] $complexProperty
     */
    private $complexProperty = array();

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV2\mapping\cs\TConditionType[] $condition
     */
    private $condition = array();

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
     * Gets as isPartial
     *
     * @return boolean
     */
    public function getIsPartial()
    {
        return $this->isPartial;
    }

    /**
     * Sets a new isPartial
     *
     * @param  boolean $isPartial
     * @return self
     */
    public function setIsPartial($isPartial)
    {
        $this->isPartial = $isPartial;
        return $this;
    }

    /**
     * Adds as scalarProperty
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV2\mapping\cs\TScalarPropertyType $scalarProperty
     */
    public function addToScalarProperty(TScalarPropertyType $scalarProperty)
    {
        $this->scalarProperty[] = $scalarProperty;
        return $this;
    }

    /**
     * isset scalarProperty
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetScalarProperty($index)
    {
        return isset($this->scalarProperty[$index]);
    }

    /**
     * unset scalarProperty
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetScalarProperty($index)
    {
        unset($this->scalarProperty[$index]);
    }

    /**
     * Gets as scalarProperty
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV2\mapping\cs\TScalarPropertyType[]
     */
    public function getScalarProperty()
    {
        return $this->scalarProperty;
    }

    /**
     * Sets a new scalarProperty
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV2\mapping\cs\TScalarPropertyType[] $scalarProperty
     * @return self
     */
    public function setScalarProperty(array $scalarProperty)
    {
        $this->scalarProperty = $scalarProperty;
        return $this;
    }

    /**
     * Adds as complexProperty
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV2\mapping\cs\TComplexPropertyType $complexProperty
     */
    public function addToComplexProperty(TComplexPropertyType $complexProperty)
    {
        $this->complexProperty[] = $complexProperty;
        return $this;
    }

    /**
     * isset complexProperty
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetComplexProperty($index)
    {
        return isset($this->complexProperty[$index]);
    }

    /**
     * unset complexProperty
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetComplexProperty($index)
    {
        unset($this->complexProperty[$index]);
    }

    /**
     * Gets as complexProperty
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV2\mapping\cs\TComplexPropertyType[]
     */
    public function getComplexProperty()
    {
        return $this->complexProperty;
    }

    /**
     * Sets a new complexProperty
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV2\mapping\cs\TComplexPropertyType[] $complexProperty
     * @return self
     */
    public function setComplexProperty(array $complexProperty)
    {
        $this->complexProperty = $complexProperty;
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
}
