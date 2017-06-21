<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\mapping\cs;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\Groups\TPropertyGroup;

/**
 * Class representing TMappingFragmentType
 *
 * Type for MappingFragment element
 *
 * XSD Type: TMappingFragment
 */
class TMappingFragmentType extends IsOK
{
    use TPropertyGroup;
    /**
     * @property string $storeEntitySet
     */
    private $storeEntitySet = null;

    /**
     * @property boolean $makeColumnsDistinct
     */
    private $makeColumnsDistinct = null;

    /**
     * Gets as storeEntitySet
     *
     * @return string
     */
    public function getStoreEntitySet()
    {
        return $this->storeEntitySet;
    }

    /**
     * Sets a new storeEntitySet
     *
     * @param  string $storeEntitySet
     * @return self
     */
    public function setStoreEntitySet($storeEntitySet)
    {
        if (!$this->isStringNotNullOrEmpty($storeEntitySet)) {
            $msg = 'Name cannot be null or empty';
            throw new \InvalidArgumentException($msg);
        }
        $this->storeEntitySet = $storeEntitySet;
        return $this;
    }

    /**
     * Gets as makeColumnsDistinct
     *
     * @return boolean
     */
    public function getMakeColumnsDistinct()
    {
        return $this->makeColumnsDistinct;
    }

    /**
     * Sets a new makeColumnsDistinct
     *
     * @param  boolean $makeColumnsDistinct
     * @return self
     */
    public function setMakeColumnsDistinct($makeColumnsDistinct)
    {
        $this->makeColumnsDistinct = $makeColumnsDistinct;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (!$this->isStringNotNullOrEmpty($this->storeEntitySet)) {
            $msg = 'Name cannot be null or empty';
            return false;
        }
        if (!$this->isPropertyGroupOK($msg)) {
            return false;
        }
        return true;
    }
}
