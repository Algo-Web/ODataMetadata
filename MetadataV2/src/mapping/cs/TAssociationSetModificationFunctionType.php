<?php

namespace MetadataV2\mapping\cs;

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
     * @property \MetadataV2\mapping\cs\TFunctionMappingEndPropertyType $endProperty
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
     * @return \MetadataV2\mapping\cs\TFunctionMappingEndPropertyType
     */
    public function getEndProperty()
    {
        return $this->endProperty;
    }

    /**
     * Sets a new endProperty
     *
     * @param \MetadataV2\mapping\cs\TFunctionMappingEndPropertyType $endProperty
     * @return self
     */
    public function setEndProperty(\MetadataV2\mapping\cs\TFunctionMappingEndPropertyType $endProperty)
    {
        $this->endProperty = $endProperty;
        return $this;
    }


}

