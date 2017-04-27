<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\mapping\cs;

/**
 * Class representing TModificationFunctionMappingEndPropertyType
 *
 *
 * XSD Type: TModificationFunctionMappingEndProperty
 */
class TModificationFunctionMappingEndPropertyType
{

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
}
