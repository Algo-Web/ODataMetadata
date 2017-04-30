<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\mapping\cs;

use AlgoWeb\ODataMetadata\IsOK;

/**
 * Class representing TAssociationSetModificationFunctionType
 *
 *
 * XSD Type: TAssociationSetModificationFunction
 */
class TAssociationSetModificationFunctionType extends IsOK
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
     * @property \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TModificationFunctionMappingEndPropertyType
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
     * @return \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TModificationFunctionMappingEndPropertyType
     */
    public function getEndProperty()
    {
        return $this->endProperty;
    }

    /**
     * Sets a new endProperty
     *
     * @param \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TModificationFunctionMappingEndPropertyType
     * $endProperty
     * @return self
     */
    public function setEndProperty(TModificationFunctionMappingEndPropertyType $endProperty)
    {
        $this->endProperty = $endProperty;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (!$this->isStringNotNullOrEmpty($this->functionName)) {
            $msg = 'Function name cannot be null or empty';
            return false;
        }
        if (null != $this->rowsAffectedParameter) {
            if (!$this->isStringNotNullOrEmpty($this->rowsAffectedParameter)) {
                $msg = 'Rows affected parameter cannot be empty';
                return false;
            }
        }
        if (null != $this->endProperty && !$this->endProperty->isOK($msg)) {
            return false;
        }
        return true;
    }
}
