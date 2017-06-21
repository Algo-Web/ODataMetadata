<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\mapping\cs;

use AlgoWeb\ODataMetadata\IsOK;

/**
 * Class representing TEntityTypeModificationFunctionMappingType
 *
 * Type for EntityTypeMapping/ModificationFunctionMapping element
 *
 * XSD Type: TEntityTypeModificationFunctionMapping
 */
class TEntityTypeModificationFunctionMappingType extends IsOK
{

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TEntityTypeModificationFunctionType
     * $deleteFunction
     */
    private $deleteFunction = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TEntityTypeModificationFunctionWithResultType
     * $insertFunction
     */
    private $insertFunction = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TEntityTypeModificationFunctionWithResultType
     * $updateFunction
     */
    private $updateFunction = null;

    /**
     * Gets as deleteFunction
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TEntityTypeModificationFunctionType
     */
    public function getDeleteFunction()
    {
        return $this->deleteFunction;
    }

    /**
     * Sets a new deleteFunction
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TEntityTypeModificationFunctionType
     * $deleteFunction
     * @return self
     */
    public function setDeleteFunction(TEntityTypeModificationFunctionType $deleteFunction)
    {
        $msg = null;
        if (!$deleteFunction->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->deleteFunction = $deleteFunction;
        return $this;
    }

    /**
     * Gets as insertFunction
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TEntityTypeModificationFunctionWithResultType
     */
    public function getInsertFunction()
    {
        return $this->insertFunction;
    }

    /**
     * Sets a new insertFunction
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TEntityTypeModificationFunctionWithResultType
     * $insertFunction
     * @return self
     */
    public function setInsertFunction(TEntityTypeModificationFunctionWithResultType $insertFunction)
    {
        $msg = null;
        if (!$insertFunction->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->insertFunction = $insertFunction;
        return $this;
    }

    /**
     * Gets as updateFunction
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TEntityTypeModificationFunctionWithResultType
     */
    public function getUpdateFunction()
    {
        return $this->updateFunction;
    }

    /**
     * Sets a new updateFunction
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TEntityTypeModificationFunctionWithResultType
     * $updateFunction
     * @return self
     */
    public function setUpdateFunction(TEntityTypeModificationFunctionWithResultType $updateFunction)
    {
        $msg = null;
        if (!$updateFunction->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->updateFunction = $updateFunction;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (null != $this->deleteFunction && !$this->deleteFunction->isOK($msg)) {
            return false;
        }
        if (null != $this->insertFunction && !$this->insertFunction->isOK($msg)) {
            return false;
        }
        if (null != $this->updateFunction && !$this->updateFunction->isOK($msg)) {
            return false;
        }
        return true;
    }
}
