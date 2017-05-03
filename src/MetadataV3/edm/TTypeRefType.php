<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Groups\GEmptyElementExtensibilityTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Groups\TFacetAttributesTrait;

/**
 * Class representing TTypeRefType
 *
 *
 * XSD Type: TTypeRef
 */
class TTypeRefType extends IsOK
{
    use GEmptyElementExtensibilityTrait;
    use TFacetAttributesTrait;
    /**
     * @property string $type
     */
    private $type = null;

     /**
     * Gets as type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets a new type
     *
     * @param string $type
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (!$this->isExtensibilityElementOK($msg)) {
            return false;
        }
        if (!$this->isTFacetAttributesTraitValid($msg)) {
            return false;
        }
        return true;
    }
}
