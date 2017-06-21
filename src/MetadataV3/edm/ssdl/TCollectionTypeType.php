<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl;

use AlgoWeb\ODataMetadata\IsOK;

/**
 * Class representing TCollectionTypeType
 *
 * XSD Type: TCollectionType
 */
class TCollectionTypeType extends IsOK
{

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TPropertyType[] $rowType
     */
    private $rowType = [];

    /**
     * Adds as property
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TPropertyType $property
     */
    public function addToRowType(TPropertyType $property)
    {
        $msg = null;
        if (!$property->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->rowType[] = $property;
        return $this;
    }

    /**
     * isset rowType
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetRowType($index)
    {
        return isset($this->rowType[$index]);
    }

    /**
     * unset rowType
     *
     * @param  scalar $index
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
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TPropertyType[] $rowType
     * @return self
     */
    public function setRowType(array $rowType)
    {
        $msg = null;
        if (!$this->isValidArrayOK(
            $rowType,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TPropertyType',
            $msg,
            1
        )
        ) {
            throw new \InvalidArgumentException($msg);
        }
        $this->rowType = $rowType;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (!$this->isValidArrayOK(
            $this->rowType,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TPropertyType',
            $msg,
            1
        )
        ) {
            return false;
        }
        return true;
    }
}
