<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edmx;

use AlgoWeb\ODataMetadata\IsOK;

/**
 * Class representing TOptionsType
 *
 *
 * XSD Type: TOptions
 */
class TOptionsType extends IsOK
{

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edmx\TDesignerPropertyType[] $designerInfoPropertySet
     */
    private $designerInfoPropertySet = [];

    /**
     * Adds as designerProperty
     *
     * @return self
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edmx\TDesignerPropertyType $designerProperty
     */
    public function addToDesignerInfoPropertySet(TDesignerPropertyType $designerProperty)
    {
        $this->designerInfoPropertySet[] = $designerProperty;
        return $this;
    }

    /**
     * isset designerInfoPropertySet
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetDesignerInfoPropertySet($index)
    {
        return isset($this->designerInfoPropertySet[$index]);
    }

    /**
     * unset designerInfoPropertySet
     *
     * @param scalar $index
     * @return void
     */
    public function unsetDesignerInfoPropertySet($index)
    {
        unset($this->designerInfoPropertySet[$index]);
    }

    /**
     * Gets as designerInfoPropertySet
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edmx\TDesignerPropertyType[]
     */
    public function getDesignerInfoPropertySet()
    {
        return $this->designerInfoPropertySet;
    }

    /**
     * Sets a new designerInfoPropertySet
     *
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edmx\TDesignerPropertyType[] $designerInfoPropertySet
     * @return self
     */
    public function setDesignerInfoPropertySet(array $designerInfoPropertySet)
    {
        $this->designerInfoPropertySet = $designerInfoPropertySet;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (!$this->isValidArray(
            $this->designerInfoPropertySet,
            '\AlgoWeb\ODataMetadata\MetadataV3\edmx\TDesignerPropertyType'
        )) {
            $msg = "Designer info property set not a valid array";
            return false;
        }
        if (!$this->isChildArrayOK($this->designerInfoPropertySet, $msg)) {
            return false;
        }
    }
}