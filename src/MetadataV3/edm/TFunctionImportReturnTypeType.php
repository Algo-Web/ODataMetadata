<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\IsOKTraits\IsOKToolboxTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TFunctionImportParameterAndReturnTypeTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TSimpleIdentifierTrait;

/**
 * Class representing TFunctionImportReturnTypeType
 *
 * XSD Type: TFunctionImportReturnType
 */
class TFunctionImportReturnTypeType extends IsOK
{
    use IsOKToolboxTrait, TSimpleIdentifierTrait, TFunctionImportParameterAndReturnTypeTrait {
        TSimpleIdentifierTrait::isNCName insteadof TFunctionImportParameterAndReturnTypeTrait;
        TSimpleIdentifierTrait::matchesRegexPattern insteadof TFunctionImportParameterAndReturnTypeTrait;
        TSimpleIdentifierTrait::isName insteadof TFunctionImportParameterAndReturnTypeTrait;
    }
    /**
     * @property string $type
     */
    private $type = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TOperandType $entitySet
     */
    private $entitySet = null;

    /**
     * @property string $entitySetAttribute
     */
    private $entitySetAttribute = null;

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
        if (null != $type && !$this->isTFunctionImportParameterAndReturnTypeValid($type)) {
            $msg = "Type must be a valid TFunctionImportParameterAndReturnType";
            throw new \InvalidArgumentException($msg);
        }
        $this->type = $type;
        return $this;
    }

    /**
     * Gets as entitySet
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TOperandType
     */
    public function getEntitySet()
    {
        return $this->entitySet;
    }

    /**
     * Sets a new entitySet
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TOperandType $entitySet
     * @return self
     */
    public function setEntitySet(TOperandType $entitySet)
    {
        $msg = null;
        if (!$entitySet->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->entitySet = $entitySet;
        return $this;
    }

    /**
     * Gets as entitySetAttribute
     *
     * @return $string
     */
    public function getEntitySetAttribute()
    {
        return $this->entitySetAttribute;
    }

    /**
     * Sets a new entitySet
     *
     * @param  string $entitySetAttribute
     * @return self
     */
    public function setEntitySetAttribute($entitySetAttribute)
    {
        if (!is_string($entitySetAttribute)) {
            $msg = "EntitySet attribute must be a string";
            throw new \InvalidArgumentException($msg);
        }
        if (!$this->isTSimpleIdentifierValid($entitySetAttribute)) {
            $msg = "Entity set attribute must be a valid TSimpleIdentifier";
            throw new \InvalidArgumentException($msg);
        }
        $this->entitySetAttribute = $entitySetAttribute;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (!$this->isTSimpleIdentifierValid($this->entitySetAttribute)) {
            $msg = "Entity set attribute must be a valid TSimpleIdentifier";
            return false;
        };
        if (!$this->isObjectNullOrType('\AlgoWeb\ODataMetadata\MetadataV3\edm\TOperandType', $this->entitySet)) {
            return false;
        };
        if (null != $this->type && !$this->isTFunctionImportParameterAndReturnTypeValid($this->type)) {
            $msg = "Type must be a valid TFunctionImportParameterAndReturnType";
            return false;
        }
        return true;
    }
}
