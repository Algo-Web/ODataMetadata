<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\mapping\cs;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\Groups\TEntityTypeModificationFunctionMappingPropertyGroup;

/**
 * Class representing TEntityTypeModificationFunctionType
 *
 * Type for entity type DeleteFunction
 *
 * XSD Type: TEntityTypeModificationFunction
 */
class TEntityTypeModificationFunctionType extends IsOK
{
    use TEntityTypeModificationFunctionMappingPropertyGroup;
    /**
     * @property string $functionName
     */
    private $functionName = null;

    /**
     * @property string $rowsAffectedParameter
     */
    private $rowsAffectedParameter = null;

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
     * @param  string $functionName
     * @return self
     */
    public function setFunctionName($functionName)
    {
        if (!$this->isStringNotNullOrEmpty($functionName)) {
            $msg = 'Function name cannot be null or empty';
            throw new \InvalidArgumentException($msg);
        }
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
     * @param  string $rowsAffectedParameter
     * @return self
     */
    public function setRowsAffectedParameter($rowsAffectedParameter)
    {
        $this->rowsAffectedParameter = $rowsAffectedParameter;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (!$this->isStringNotNullOrEmpty($this->functionName)) {
            $msg = 'Function name cannot be null or empty';
            return false;
        }
        if (!$this->isMappingPropertyGroupOK($msg)) {
            return false;
        }

        return true;
    }
}
