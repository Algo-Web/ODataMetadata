<?php

namespace MetadataV3\edmx;

/**
 * Class representing TOptionsType
 *
 *
 * XSD Type: TOptions
 */
class TOptionsType
{

    /**
     * @property \MetadataV3\edmx\TDesignerPropertyType[] $designerInfoPropertySet
     */
    private $designerInfoPropertySet = null;

    /**
     * Adds as designerProperty
     *
     * @return self
     * @param \MetadataV3\edmx\TDesignerPropertyType $designerProperty
     */
    public function addToDesignerInfoPropertySet(\MetadataV3\edmx\TDesignerPropertyType $designerProperty)
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
     * @return \MetadataV3\edmx\TDesignerPropertyType[]
     */
    public function getDesignerInfoPropertySet()
    {
        return $this->designerInfoPropertySet;
    }

    /**
     * Sets a new designerInfoPropertySet
     *
     * @param \MetadataV3\edmx\TDesignerPropertyType[] $designerInfoPropertySet
     * @return self
     */
    public function setDesignerInfoPropertySet(array $designerInfoPropertySet)
    {
        $this->designerInfoPropertySet = $designerInfoPropertySet;
        return $this;
    }


}

