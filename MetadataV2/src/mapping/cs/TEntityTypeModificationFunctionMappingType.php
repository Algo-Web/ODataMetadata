<?php

namespace MetadataV2\mapping\cs;

/**
 * Class representing TEntityTypeModificationFunctionMappingType
 *
 *
 * XSD Type: TEntityTypeModificationFunctionMapping
 */
class TEntityTypeModificationFunctionMappingType
{

    /**
     * @property \MetadataV2\mapping\cs\TEntityTypeModificationFunctionType
     * $deleteFunction
     */
    private $deleteFunction = null;

    /**
     * @property \MetadataV2\mapping\cs\TEntityTypeModificationFunctionWithResultType
     * $insertFunction
     */
    private $insertFunction = null;

    /**
     * @property \MetadataV2\mapping\cs\TEntityTypeModificationFunctionWithResultType
     * $updateFunction
     */
    private $updateFunction = null;

    /**
     * Gets as deleteFunction
     *
     * @return \MetadataV2\mapping\cs\TEntityTypeModificationFunctionType
     */
    public function getDeleteFunction()
    {
        return $this->deleteFunction;
    }

    /**
     * Sets a new deleteFunction
     *
     * @param \MetadataV2\mapping\cs\TEntityTypeModificationFunctionType
     * $deleteFunction
     * @return self
     */
    public function setDeleteFunction(\MetadataV2\mapping\cs\TEntityTypeModificationFunctionType $deleteFunction)
    {
        $this->deleteFunction = $deleteFunction;
        return $this;
    }

    /**
     * Gets as insertFunction
     *
     * @return \MetadataV2\mapping\cs\TEntityTypeModificationFunctionWithResultType
     */
    public function getInsertFunction()
    {
        return $this->insertFunction;
    }

    /**
     * Sets a new insertFunction
     *
     * @param \MetadataV2\mapping\cs\TEntityTypeModificationFunctionWithResultType
     * $insertFunction
     * @return self
     */
    public function setInsertFunction(\MetadataV2\mapping\cs\TEntityTypeModificationFunctionWithResultType $insertFunction)
    {
        $this->insertFunction = $insertFunction;
        return $this;
    }

    /**
     * Gets as updateFunction
     *
     * @return \MetadataV2\mapping\cs\TEntityTypeModificationFunctionWithResultType
     */
    public function getUpdateFunction()
    {
        return $this->updateFunction;
    }

    /**
     * Sets a new updateFunction
     *
     * @param \MetadataV2\mapping\cs\TEntityTypeModificationFunctionWithResultType
     * $updateFunction
     * @return self
     */
    public function setUpdateFunction(\MetadataV2\mapping\cs\TEntityTypeModificationFunctionWithResultType $updateFunction)
    {
        $this->updateFunction = $updateFunction;
        return $this;
    }


}

