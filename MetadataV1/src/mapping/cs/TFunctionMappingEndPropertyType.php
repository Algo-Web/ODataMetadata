<?php

namespace MetadataV1\mapping\cs;

/**
 * Class representing TFunctionMappingEndPropertyType
 *
 *
 * XSD Type: TFunctionMappingEndProperty
 */
class TFunctionMappingEndPropertyType
{

    /**
     * @property string $name
     */
    private $name = null;

    /**
     * @property \MetadataV1\mapping\cs\TFunctionMappingScalarPropertyType
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
     * @return \MetadataV1\mapping\cs\TFunctionMappingScalarPropertyType
     */
    public function getScalarProperty()
    {
        return $this->scalarProperty;
    }

    /**
     * Sets a new scalarProperty
     *
     * @param \MetadataV1\mapping\cs\TFunctionMappingScalarPropertyType $scalarProperty
     * @return self
     */
    public function setScalarProperty(\MetadataV1\mapping\cs\TFunctionMappingScalarPropertyType $scalarProperty)
    {
        $this->scalarProperty = $scalarProperty;
        return $this;
    }
}
