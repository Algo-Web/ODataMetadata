<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Groups\GEmptyElementExtensibilityTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Groups\TFacetAttributesTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TUnwrappedFunctionTypeTrait;

/**
 * Class representing TTypeRefType
 *
 * XSD Type: TTypeRef
 */
class TTypeRefType extends IsOK
{
    use GEmptyElementExtensibilityTrait, TFacetAttributesTrait, TUnwrappedFunctionTypeTrait {
        TFacetAttributesTrait::isStringNotNullOrEmpty insteadof GEmptyElementExtensibilityTrait;
        TFacetAttributesTrait::isStringNotNull insteadof GEmptyElementExtensibilityTrait;
        TFacetAttributesTrait::isNotNullInstanceOf insteadof GEmptyElementExtensibilityTrait;
        TFacetAttributesTrait::isNullInstanceOf insteadof GEmptyElementExtensibilityTrait;
        TFacetAttributesTrait::isURLValid insteadof GEmptyElementExtensibilityTrait;
        TFacetAttributesTrait::isObjectNullOrOK insteadof GEmptyElementExtensibilityTrait;
        TFacetAttributesTrait::isObjectNullOrType insteadof GEmptyElementExtensibilityTrait;
        TFacetAttributesTrait::isValidArrayOK insteadof GEmptyElementExtensibilityTrait;
        TFacetAttributesTrait::isValidArray insteadof GEmptyElementExtensibilityTrait;
        TFacetAttributesTrait::isChildArrayOK insteadof GEmptyElementExtensibilityTrait;
    }
    
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
     * @param  string $type
     * @return self
     */
    public function setType($type)
    {
        if (!$this->isTUnwrappedFunctionTypeValid($type)) {
            $msg = "Type must be a valid TUnwrappedFunctionType";
            throw new \InvalidArgumentException($msg);
        }
        $this->type = $type;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (!$this->isTUnwrappedFunctionTypeValid($this->type)) {
            $msg = "Type must be a valid TUnwrappedFunctionType";
            return false;
        }
        if (!$this->isExtensibilityElementOK($msg)) {
            return false;
        }
        if (!$this->isTFacetAttributesTraitValid($msg)) {
            return false;
        }
        return true;
    }
}
