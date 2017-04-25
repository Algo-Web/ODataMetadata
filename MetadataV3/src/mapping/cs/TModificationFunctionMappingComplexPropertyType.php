<?php

namespace MetadataV3\mapping\cs;

/**
 * Class representing TModificationFunctionMappingComplexPropertyType
 *
 *
 * XSD Type: TModificationFunctionMappingComplexProperty
 */
class TModificationFunctionMappingComplexPropertyType
{

    /**
     * @property string $name
     */
    private $name = null;

    /**
     * @property string $typeName
     */
    private $typeName = null;

    /**
     * @property \MetadataV3\mapping\cs\TModificationFunctionMappingScalarPropertyType
     * $scalarProperty
     */
    private $scalarProperty = null;

    /**
     * @property \MetadataV3\mapping\cs\TModificationFunctionMappingComplexPropertyType
     * $complexProperty
     */
    private $complexProperty = null;

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
     * Gets as typeName
     *
     * @return string
     */
    public function getTypeName()
    {
        return $this->typeName;
    }

    /**
     * Sets a new typeName
     *
     * @param string $typeName
     * @return self
     */
    public function setTypeName($typeName)
    {
        $this->typeName = $typeName;
        return $this;
    }

    /**
     * Gets as scalarProperty
     *
     * @return \MetadataV3\mapping\cs\TModificationFunctionMappingScalarPropertyType
     */
    public function getScalarProperty()
    {
        return $this->scalarProperty;
    }

    /**
     * Sets a new scalarProperty
     *
     * @param \MetadataV3\mapping\cs\TModificationFunctionMappingScalarPropertyType
     * $scalarProperty
     * @return self
     */
    public function setScalarProperty(\MetadataV3\mapping\cs\TModificationFunctionMappingScalarPropertyType $scalarProperty)
    {
        $this->scalarProperty = $scalarProperty;
        return $this;
    }

    /**
     * Gets as complexProperty
     *
     * @return \MetadataV3\mapping\cs\TModificationFunctionMappingComplexPropertyType
     */
    public function getComplexProperty()
    {
        return $this->complexProperty;
    }

    /**
     * Sets a new complexProperty
     *
     * @param \MetadataV3\mapping\cs\TModificationFunctionMappingComplexPropertyType
     * $complexProperty
     * @return self
     */
    public function setComplexProperty(\MetadataV3\mapping\cs\TModificationFunctionMappingComplexPropertyType $complexProperty)
    {
        $this->complexProperty = $complexProperty;
        return $this;
    }


}

