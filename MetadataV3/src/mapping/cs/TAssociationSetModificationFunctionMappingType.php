<?php

namespace MetadataV3\mapping\cs;

/**
 * Class representing TAssociationSetModificationFunctionMappingType
 *
 *
 * XSD Type: TAssociationSetModificationFunctionMapping
 */
class TAssociationSetModificationFunctionMappingType
{

    /**
     * @property \MetadataV3\mapping\cs\TAssociationSetModificationFunctionType
     * $deleteFunction
     */
    private $deleteFunction = null;

    /**
     * @property \MetadataV3\mapping\cs\TAssociationSetModificationFunctionType
     * $insertFunction
     */
    private $insertFunction = null;

    /**
     * Gets as deleteFunction
     *
     * @return \MetadataV3\mapping\cs\TAssociationSetModificationFunctionType
     */
    public function getDeleteFunction()
    {
        return $this->deleteFunction;
    }

    /**
     * Sets a new deleteFunction
     *
     * @param \MetadataV3\mapping\cs\TAssociationSetModificationFunctionType
     * $deleteFunction
     * @return self
     */
    public function setDeleteFunction(\MetadataV3\mapping\cs\TAssociationSetModificationFunctionType $deleteFunction)
    {
        $this->deleteFunction = $deleteFunction;
        return $this;
    }

    /**
     * Gets as insertFunction
     *
     * @return \MetadataV3\mapping\cs\TAssociationSetModificationFunctionType
     */
    public function getInsertFunction()
    {
        return $this->insertFunction;
    }

    /**
     * Sets a new insertFunction
     *
     * @param \MetadataV3\mapping\cs\TAssociationSetModificationFunctionType
     * $insertFunction
     * @return self
     */
    public function setInsertFunction(\MetadataV3\mapping\cs\TAssociationSetModificationFunctionType $insertFunction)
    {
        $this->insertFunction = $insertFunction;
        return $this;
    }


}

