<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\mapping\cs;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\IsOKTraits\TSimpleIdentifierTrait;

/**
 * Class representing TModificationFunctionMappingEndPropertyType
 *
 *
 * XSD Type: TModificationFunctionMappingEndProperty
 */
class TModificationFunctionMappingEndPropertyType extends IsOK
{
    use TSimpleIdentifierTrait;
    /**
     * @property string $name
     */
    private $name = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TModificationFunctionMappingScalarPropertyType
     * $scalarProperty
     */
    private $scalarProperty = null;

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
     * @param string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Gets as scalarProperty
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TModificationFunctionMappingScalarPropertyType
     */
    public function getScalarProperty()
    {
        return $this->scalarProperty;
    }

    /**
     * Sets a new scalarProperty
     *
     * @param \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TModificationFunctionMappingScalarPropertyType
     * $scalarProperty
     * @return self
     */
    public function setScalarProperty(TModificationFunctionMappingScalarPropertyType $scalarProperty)
    {
        $this->scalarProperty = $scalarProperty;
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
        if (null != $this->scalarProperty && !$this->scalarProperty->isOK($msg)) {
            return false;
        }
        return true;
    }
}
