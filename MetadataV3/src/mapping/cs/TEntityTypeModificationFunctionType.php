<?php

namespace MetadataV3\mapping\cs;

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
     * @property \MetadataV3\mapping\cs\TModificationFunctionMappingScalarPropertyType
     * $scalarProperty
     */
    private $scalarProperty = null;

    /**
     * @property \MetadataV3\mapping\cs\TModificationFunctionMappingAssociationEndType
     * $associationEnd
     */
    private $associationEnd = null;

    /**
     * @property \MetadataV3\mapping\cs\TModificationFunctionMappingComplexPropertyType
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
     * Gets as associationEnd
     *
     * @return \MetadataV3\mapping\cs\TModificationFunctionMappingAssociationEndType
     */
    public function getAssociationEnd()
    {
        return $this->associationEnd;
    }

    /**
     * Sets a new associationEnd
     *
     * @param \MetadataV3\mapping\cs\TModificationFunctionMappingAssociationEndType
     * $associationEnd
     * @return self
     */
    public function setAssociationEnd(\MetadataV3\mapping\cs\TModificationFunctionMappingAssociationEndType $associationEnd)
    {
        $this->associationEnd = $associationEnd;
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

