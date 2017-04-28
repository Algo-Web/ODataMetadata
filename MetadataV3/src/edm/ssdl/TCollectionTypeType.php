<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl;

/**
 * Class representing TCollectionTypeType
 *
 *
 * XSD Type: TCollectionType
 */
class TCollectionTypeType
{

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TPropertyType[] $rowType
     */
    private $rowType = null;

    /**
     * Adds as property
     *
     * @return self
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TPropertyType $property
     */
    public function addToRowType(TPropertyType $property)
    {
        $this->rowType[] = $property;
        return $this;
    }

    /**
     * isset rowType
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetRowType($index)
    {
        return isset($this->rowType[$index]);
    }

    /**
     * unset rowType
     *
     * @param scalar $index
     * @return void
     */
    public function unsetRowType($index)
    {
        unset($this->rowType[$index]);
    }

    /**
     * Gets as rowType
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TPropertyType[]
     */
    public function getRowType()
    {
        return $this->rowType;
    }

    /**
     * Sets a new rowType
     *
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TPropertyType[] $rowType
     * @return self
     */
    public function setRowType(array $rowType)
    {
        $this->rowType = $rowType;
        return $this;
    }
}
