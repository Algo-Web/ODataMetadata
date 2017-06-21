<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\mapping\cs;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\Groups\TModificationFunctionMappingAssociationEndPropertyGroup;
use AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\IsOKTraits\TSimpleIdentifierTrait;

/**
 * Class representing TModificationFunctionMappingEndPropertyType
 *
 * Type for function mapping end property
 *
 * XSD Type: TModificationFunctionMappingEndProperty
 */
class TModificationFunctionMappingEndPropertyType extends IsOK
{
    use TSimpleIdentifierTrait, TModificationFunctionMappingAssociationEndPropertyGroup;
    /**
     * @property string $name
     */
    private $name = null;

    /**
     * Gets as name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets a new name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        if (!$this->isStringNotNullOrEmpty($name)) {
            $msg = 'Name cannot be null or empty';
            throw new \InvalidArgumentException($msg);
        }
        if (!$this->isTSimpleIdentifierValid($name)) {
            $msg = 'Name must be a valid TSimpleIdentifier';
            throw new \InvalidArgumentException($msg);
        }
        $this->name = $name;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (!$this->isStringNotNullOrEmpty($this->name)) {
            $msg = 'Name cannot be null or empty';
            return false;
        }
        if (!$this->isTSimpleIdentifierValid($this->name)) {
            $msg = 'Name must be a valid TSimpleIdentifier';
            return false;
        }
        if (!$this->isModificationFunctionMappingAssociationOK($msg)) {
            return false;
        }
        return true;
    }
}
