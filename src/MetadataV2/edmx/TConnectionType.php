<?php

namespace AlgoWeb\ODataMetadata\MetadataV2\edmx;

use AlgoWeb\ODataMetadata\IsOK;

/**
 * Class representing TConnectionType.
 *
 * XSD Type: TConnection
 */
class TConnectionType extends IsOK
{

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV2\edmx\TDesignerPropertyType[] $designerInfoPropertySet
     */
    private $designerInfoPropertySet = null;

    /**
     * Adds as designerProperty.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV2\edmx\TDesignerPropertyType $designerProperty
     * @return self
     */
    public function addToDesignerInfoPropertySet(TDesignerPropertyType $designerProperty)
    {
        $this->designerInfoPropertySet[] = $designerProperty;
        return $this;
    }

    /**
     * isset designerInfoPropertySet.
     *
     * @param  int $index
     * @return bool
     */
    public function issetDesignerInfoPropertySet($index)
    {
        return isset($this->designerInfoPropertySet[$index]);
    }

    /**
     * unset designerInfoPropertySet.
     *
     * @param  int $index
     * @return void
     */
    public function unsetDesignerInfoPropertySet($index)
    {
        unset($this->designerInfoPropertySet[$index]);
    }

    /**
     * Gets as designerInfoPropertySet.
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV2\edmx\TDesignerPropertyType[]
     */
    public function getDesignerInfoPropertySet()
    {
        return $this->designerInfoPropertySet;
    }

    /**
     * Sets a new designerInfoPropertySet.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV2\edmx\TDesignerPropertyType[] $designerInfoPropertySet
     * @return self
     */
    public function setDesignerInfoPropertySet(array $designerInfoPropertySet)
    {
        $this->designerInfoPropertySet = $designerInfoPropertySet;
        return $this;
    }
}
