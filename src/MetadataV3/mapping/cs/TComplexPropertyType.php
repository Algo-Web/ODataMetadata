<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\mapping\cs;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV4\edm\IsOKTraits\TSimpleIdentifierTrait;

/**
 * Class representing TComplexPropertyType
 *
 * Type for Complex Property Map elements
 *
 * XSD Type: TComplexProperty
 */
class TComplexPropertyType extends IsOK
{
    use TSimpleIdentifierTrait;
    /**
     * @property string $name
     */
    private $name = null;

    /**
     * @property string $typeName
     */
    private $typeName = null;

    /**
     * @property boolean $isPartial
     */
    private $isPartial = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TScalarPropertyType[] $scalarProperty
     */
    private $scalarProperty = [];

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TComplexPropertyType[] $complexProperty
     */
    private $complexProperty = [];

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TComplexTypeMappingType[] $complexTypeMapping
     */
    private $complexTypeMapping = [];

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TConditionType[] $condition
     */
    private $condition = [];

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
        if (!$this->isStringNotNullOrEmpty($name)) {
            $msg = 'Name cannot be null or empty';
            throw new \InvalidArgumentException($msg);
        }
        if (!$this->isTSimpleIdentifierValid($name)) {
            $msg = 'Name must be a valid TSimpleIdentifier';
            throw new \InvalidArgumentException($msg);
        }
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
        if (null != $typeName && !$this->isStringNotNullOrEmpty($typeName)) {
            $msg = 'Type name cannot be empty';
            throw new \InvalidArgumentException($msg);
        }
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
        $count = count($this->complexProperty) + count($this->condition) + count($this->complexTypeMapping);
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
     * Adds as complexProperty
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TComplexPropertyType $complexProperty
     */
    public function addToComplexProperty(TComplexPropertyType $complexProperty)
    {
        $msg = null;
        if (!$complexProperty->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
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
     * @return \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TComplexPropertyType[]
     */
    public function getComplexProperty()
    {
        return $this->complexProperty;
    }

    /**
     * Sets a new complexProperty
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TComplexPropertyType[] $complexProperty
     * @return self
     */
    public function setComplexProperty(array $complexProperty)
    {
        $msg = null;
        // if other arrays are empty, then the array we're assigning must not be empty
        $count = count($this->scalarProperty) + count($this->condition) + count($this->complexTypeMapping);
        if (!$this->isValidArrayOK(
            $complexProperty,
            '\AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TComplexPropertyType',
            $msg,
            0 < $count ? 0 : 1
        )
        ) {
            throw new \InvalidArgumentException($msg);
        }
        $this->complexProperty = $complexProperty;
        return $this;
    }

    /**
     * Adds as complexTypeMapping
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TComplexTypeMappingType $complexTypeMapping
     */
    public function addToComplexTypeMapping(TComplexTypeMappingType $complexTypeMapping)
    {
        $msg = null;
        if (!$complexTypeMapping->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->complexTypeMapping[] = $complexTypeMapping;
        return $this;
    }

    /**
     * isset complexTypeMapping
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetComplexTypeMapping($index)
    {
        return isset($this->complexTypeMapping[$index]);
    }

    /**
     * unset complexTypeMapping
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetComplexTypeMapping($index)
    {
        unset($this->complexTypeMapping[$index]);
    }

    /**
     * Gets as complexTypeMapping
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TComplexTypeMappingType[]
     */
    public function getComplexTypeMapping()
    {
        return $this->complexTypeMapping;
    }

    /**
     * Sets a new complexTypeMapping
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TComplexTypeMappingType[] $complexTypeMapping
     * @return self
     */
    public function setComplexTypeMapping(array $complexTypeMapping)
    {
        $msg = null;
        // if other arrays are empty, then the array we're assigning must not be empty
        $count = count($this->scalarProperty) + count($this->complexProperty) + count($this->condition);
        if (!$this->isValidArrayOK(
            $complexTypeMapping,
            '\AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TConditionType',
            $msg,
            0 < $count ? 0 : 1
        )
        ) {
            throw new \InvalidArgumentException($msg);
        }
        $this->complexTypeMapping = $complexTypeMapping;
        return $this;
    }

    /**
     * Adds as condition
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TConditionType $condition
     */
    public function addToCondition(TConditionType $condition)
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
     * @return \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TConditionType[]
     */
    public function getCondition()
    {
        return $this->condition;
    }

    /**
     * Sets a new condition
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TConditionType[] $condition
     * @return self
     */
    public function setCondition(array $condition)
    {
        $msg = null;
        // if other arrays are empty, then the array we're assigning must not be empty
        $count = count($this->scalarProperty) + count($this->complexProperty) + count($this->complexTypeMapping);
        if (!$this->isValidArrayOK(
            $condition,
            '\AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TConditionType',
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
        if (!$this->isStringNotNullOrEmpty($this->name)) {
            $msg = 'Name cannot be null or empty';
            return false;
        }
        if (null != $this->typeName && !$this->isStringNotNullOrEmpty($this->typeName)) {
            $msg = 'Type name cannot be empty';
            return false;
        }
        if (!$this->isTSimpleIdentifierValid($this->name)) {
            $msg = 'Name must be a valid TSimpleIdentifier';
            return false;
        }
        $count = count($this->scalarProperty) + count($this->complexProperty) + count($this->condition)
                 + count($this->complexTypeMapping);
        if (1 > $count) {
            $msg = "Cannot have all arrays empty";
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
            $this->complexProperty,
            '\AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TComplexPropertyType'
        )
        ) {
            $msg = "Complex property array not a valid array";
            return false;
        }
        if (!$this->isChildArrayOK($this->complexProperty, $msg)) {
            return false;
        }
        if (!$this->isValidArray(
            $this->condition,
            '\AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TConditionType'
        )
        ) {
            $msg = "Condition array not a valid array";
            return false;
        }
        if (!$this->isChildArrayOK($this->condition, $msg)) {
            return false;
        }
        if (!$this->isValidArray(
            $this->complexTypeMapping,
            '\AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TComplexTypeMappingType'
        )
        ) {
            $msg = "Complex type mapping array not a valid array";
            return false;
        }
        if (!$this->isChildArrayOK($this->complexTypeMapping, $msg)) {
            return false;
        }
        return true;
    }
}
