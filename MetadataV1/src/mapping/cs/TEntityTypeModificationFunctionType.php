<?php

namespace MetadataV1\mapping\cs;

/**
 * Class representing TEntityTypeModificationFunctionType
 *
 *
 * XSD Type: TEntityTypeModificationFunction
 */
class TEntityTypeModificationFunctionType
{

    /**
     * @property string $functionName
     */
    private $functionName = null;

    /**
     * @property string $rowsAffectedParameter
     */
    private $rowsAffectedParameter = null;

    /**
     * @property \MetadataV1\mapping\cs\TFunctionMappingScalarPropertyType
     * $scalarProperty
     */
    private $scalarProperty = null;

    /**
     * @property \MetadataV1\mapping\cs\TFunctionMappingAssociationEndType
     * $associationEnd
     */
    private $associationEnd = null;

    /**
     * @property \MetadataV1\mapping\cs\TFunctionMappingComplexPropertyType
     * $complexProperty
     */
    private $complexProperty = null;

    /**
     * Gets as functionName
     *
     * @return string
     */
    public function getFunctionName()
    {
        return $this->functionName;
    }

    /**
     * Sets a new functionName
     *
     * @param string $functionName
     * @return self
     */
    public function setFunctionName($functionName)
    {
        $this->functionName = $functionName;
        return $this;
    }

    /**
     * Gets as rowsAffectedParameter
     *
     * @return string
     */
    public function getRowsAffectedParameter()
    {
        return $this->rowsAffectedParameter;
    }

    /**
     * Sets a new rowsAffectedParameter
     *
     * @param string $rowsAffectedParameter
     * @return self
     */
    public function setRowsAffectedParameter($rowsAffectedParameter)
    {
        $this->rowsAffectedParameter = $rowsAffectedParameter;
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

    /**
     * Gets as associationEnd
     *
     * @return \MetadataV1\mapping\cs\TFunctionMappingAssociationEndType
     */
    public function getAssociationEnd()
    {
        return $this->associationEnd;
    }

    /**
     * Sets a new associationEnd
     *
     * @param \MetadataV1\mapping\cs\TFunctionMappingAssociationEndType $associationEnd
     * @return self
     */
    public function setAssociationEnd(\MetadataV1\mapping\cs\TFunctionMappingAssociationEndType $associationEnd)
    {
        $this->associationEnd = $associationEnd;
        return $this;
    }

    /**
     * Gets as complexProperty
     *
     * @return \MetadataV1\mapping\cs\TFunctionMappingComplexPropertyType
     */
    public function getComplexProperty()
    {
        return $this->complexProperty;
    }

    /**
     * Sets a new complexProperty
     *
     * @param \MetadataV1\mapping\cs\TFunctionMappingComplexPropertyType
     * $complexProperty
     * @return self
     */
    public function setComplexProperty(\MetadataV1\mapping\cs\TFunctionMappingComplexPropertyType $complexProperty)
    {
        $this->complexProperty = $complexProperty;
        return $this;
    }
}
