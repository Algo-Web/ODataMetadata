<?php

namespace MetadataV3\mapping\cs;

/**
 * Class representing TAssociationSetModificationFunctionType
 *
 *
 * XSD Type: TAssociationSetModificationFunction
 */
class TAssociationSetModificationFunctionType
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
     * @property \MetadataV3\mapping\cs\TModificationFunctionMappingEndPropertyType
     * $endProperty
     */
    private $endProperty = null;

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
     * Gets as endProperty
     *
     * @return \MetadataV3\mapping\cs\TModificationFunctionMappingEndPropertyType
     */
    public function getEndProperty()
    {
        return $this->endProperty;
    }

    /**
     * Sets a new endProperty
     *
     * @param \MetadataV3\mapping\cs\TModificationFunctionMappingEndPropertyType
     * $endProperty
     * @return self
     */
    public function setEndProperty(\MetadataV3\mapping\cs\TModificationFunctionMappingEndPropertyType $endProperty)
    {
        $this->endProperty = $endProperty;
        return $this;
    }
}
