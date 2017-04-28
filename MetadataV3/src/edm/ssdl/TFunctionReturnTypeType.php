<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl;

/**
 * Class representing TFunctionReturnTypeType
 *
 *
 * XSD Type: TFunctionReturnType
 */
class TFunctionReturnTypeType
{

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TCollectionTypeType $collectionType
     */
    private $collectionType = null;

    /**
     * Gets as collectionType
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TCollectionTypeType
     */
    public function getCollectionType()
    {
        return $this->collectionType;
    }

    /**
     * Sets a new collectionType
     *
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TCollectionTypeType $collectionType
     * @return self
     */
    public function setCollectionType(TCollectionTypeType $collectionType)
    {
        $this->collectionType = $collectionType;
        return $this;
    }
}
