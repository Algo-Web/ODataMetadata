<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\IsOKTraits\IsOKToolboxTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Groups\GEmptyElementExtensibilityTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TUnwrappedFunctionTypeTrait;

/**
 * Class representing TReferenceTypeType
 *
 *
 * XSD Type: TReferenceType
 */
class TReferenceTypeType extends IsOK
{
    use IsOKToolboxTrait, GEmptyElementExtensibilityTrait, TUnwrappedFunctionTypeTrait;
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
        if (!$this->isTUnwrappedFunctionTypeValid($this->type)) {
            $msg = "Type must be a valid TUnwrappedFunctionType";
            return false;
        }
        if (!$this->isExtensibilityElementOK($msg)) {
            return false;
        }
        return true;
    }
}
