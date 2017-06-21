<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\IsOKTraits\IsOKToolboxTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TUnwrappedFunctionTypeTrait;

/**
 * Class representing TRecordExpressionType
 *
 * XSD Type: TRecordExpression
 */
class TRecordExpressionType extends IsOK
{
    use IsOKToolboxTrait, TUnwrappedFunctionTypeTrait;
    /**
     * @property string $type
     */
    private $type = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyValueType[] $propertyValue
     */
    private $propertyValue = [];

    /**
     * Gets as type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets a new type
     *
     * @param  string $type
     * @return self
     */
    public function setType($type)
    {
        if (null != $type && !$this->isTUnwrappedFunctionTypeValid($type)) {
            $msg = "Type must be a valid TUnwrappedFunctionType";
            throw new \InvalidArgumentException($msg);
        }
        $this->type = $type;
        return $this;
    }

    /**
     * Adds as propertyValue
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyValueType $propertyValue
     */
    public function addToPropertyValue(TPropertyValueType $propertyValue)
    {
        $msg = null;
        if (!$propertyValue->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->propertyValue[] = $propertyValue;
        return $this;
    }

    /**
     * isset propertyValue
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetPropertyValue($index)
    {
        return isset($this->propertyValue[$index]);
    }

    /**
     * unset propertyValue
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetPropertyValue($index)
    {
        unset($this->propertyValue[$index]);
    }

    /**
     * Gets as propertyValue
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyValueType[]
     */
    public function getPropertyValue()
    {
        return $this->propertyValue;
    }

    /**
     * Sets a new propertyValue
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyValueType[] $propertyValue
     * @return self
     */
    public function setPropertyValue(array $propertyValue)
    {
        if (!$this->isValidArrayOK(
            $propertyValue,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyValueType',
            $msg
        )
        ) {
            throw new \InvalidArgumentException($msg);
        }
        $this->propertyValue = $propertyValue;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (null != $this->type && !$this->isTUnwrappedFunctionTypeValid($this->type)) {
            $msg = "Type must be a valid TUnwrappedFunctionType";
            return false;
        }
        if (!$this->isValidArrayOK(
            $this->propertyValue,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyValueType',
            $msg
        )
        ) {
            return false;
        }

        return true;
    }
}
