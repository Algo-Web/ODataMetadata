<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\mapping\cs;

use AlgoWeb\ODataMetadata\IsOK;

/**
 * Class representing TFunctionImportEntityTypeMappingType
 *
 * Type for (FunctionMapping|FunctionImportMapping)/EntityTypeMapping element
 *
 * XSD Type: TFunctionImportEntityTypeMapping
 */
class TFunctionImportEntityTypeMappingType extends IsOK
{

    /**
     * @property string $typeName
     */
    private $typeName = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TScalarPropertyType[] $scalarProperty
     */
    private $scalarProperty = [];

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TFunctionImportConditionType[] $condition
     */
    private $condition = [];

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
        if (!$this->isStringNotNullOrEmpty($typeName)) {
            $msg = 'Type name cannot be null or empty';
            throw new \InvalidArgumentException($msg);
        }
        $this->typeName = $typeName;
        return $this;
    }

    /**
     * Adds as scalarProperty
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TScalarPropertyType $scalarProperty
     */
    public function addToScalarProperty(TScalarPropertyType $scalarProperty)
    {
        $msg = null;
        if (!$scalarProperty->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
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
     * @return \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TScalarPropertyType[]
     */
    public function getScalarProperty()
    {
        return $this->scalarProperty;
    }

    /**
     * Sets a new scalarProperty
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TScalarPropertyType[] $scalarProperty
     * @return self
     */
    public function setScalarProperty(array $scalarProperty)
    {
        $msg = null;
        // if other arrays are empty, then the array we're assigning must not be empty
        $count = count($this->condition);
        if (!$this->isValidArrayOK(
            $scalarProperty,
            '\AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TScalarPropertyType',
            $msg,
            0 < $count ? 0 : 1
        )
        ) {
            throw new \InvalidArgumentException($msg);
        }
        $this->scalarProperty = $scalarProperty;
        return $this;
    }

    /**
     * Adds as condition
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TFunctionImportConditionType $condition
     */
    public function addToCondition(TFunctionImportConditionType $condition)
    {
        $msg = null;
        if (!$condition->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
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
     * @return \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TFunctionImportConditionType[]
     */
    public function getCondition()
    {
        return $this->condition;
    }

    /**
     * Sets a new condition
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TFunctionImportConditionType[] $condition
     * @return self
     */
    public function setCondition(array $condition)
    {
        $msg = null;
        // if other arrays are empty, then the array we're assigning must not be empty
        $count = count($this->scalarProperty);
        if (!$this->isValidArrayOK(
            $condition,
            '\AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TFunctionImportConditionType',
            $msg,
            0 < $count ? 0 : 1
        )
        ) {
            throw new \InvalidArgumentException($msg);
        }
        $this->condition = $condition;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (!$this->isStringNotNullOrEmpty($this->typeName)) {
            $msg = 'Type name cannot be null or empty';
            return false;
        }
        $count = count($this->scalarProperty) + count($this->condition);
        if (1 > $count) {
            $msg = "Scalar property array and condition array must not both be empty";
            return false;
        }
        if (!$this->isValidArray(
            $this->scalarProperty,
            '\AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TScalarPropertyType'
        )
        ) {
            $msg = "Scalar property array not a valid array";
            return false;
        }
        if (!$this->isChildArrayOK($this->scalarProperty, $msg)) {
            return false;
        }
        if (!$this->isValidArray(
            $this->condition,
            '\AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TFunctionImportConditionType'
        )
        ) {
            $msg = "Condition array not a valid array";
            return false;
        }
        if (!$this->isChildArrayOK($this->condition, $msg)) {
            return false;
        }

        return true;
    }
}
