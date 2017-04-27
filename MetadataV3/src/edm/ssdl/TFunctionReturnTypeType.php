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
     * @property \MetadataV3\edm\ssdl\TCollectionTypeType $collectionType
     */
    private $collectionType = null;

    /**
     * Gets as collectionType
     *
     * @return \MetadataV3\edm\ssdl\TCollectionTypeType
     */
    public function getCollectionType()
    {
        return $this->collectionType;
    }

    /**
     * Sets a new collectionType
     *
     * @param \MetadataV3\edm\ssdl\TCollectionTypeType $collectionType
     * @return self
     */
    public function setCollectionType(\MetadataV3\edm\ssdl\TCollectionTypeType $collectionType)
    {
        $this->collectionType = $collectionType;
        return $this;
    }
}
