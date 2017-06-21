<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\mapping\cs;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\IsOKTraits\TSimpleIdentifierTrait;

/**
 * Class representing TFunctionImportMappingType
 *
 * Type for FunctionImportMapping element
 *
 * XSD Type: TFunctionImportMapping
 */
class TFunctionImportMappingType extends IsOK
{
    use TSimpleIdentifierTrait;
    /**
     * @property string $functionName
     */
    private $functionName = null;

    /**
     * @property string $functionImportName
     */
    private $functionImportName = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TFunctionImportMappingResultMappingType[]
     * $resultMapping
     */
    private $resultMapping = [];

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
     * Gets as functionImportName
     *
     * @return string
     */
    public function getFunctionImportName()
    {
        return $this->functionImportName;
    }

    /**
     * Sets a new functionImportName
     *
     * @param  string $functionImportName
     * @return self
     */
    public function setFunctionImportName($functionImportName)
    {
        if (!$this->isStringNotNullOrEmpty($functionImportName)) {
            $msg = 'Function import name cannot be null or empty';
            throw new \InvalidArgumentException($msg);
        }
        if (!$this->isTSimpleIdentifierValid($functionImportName)) {
            $msg = 'Function import name must be a valid TSimpleIdentifier';
            throw new \InvalidArgumentException($msg);
        }
        $this->functionImportName = $functionImportName;
        return $this;
    }

    /**
     * Adds as resultMapping
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TFunctionImportMappingResultMappingType
     * $resultMapping
     */
    public function addToResultMapping(TFunctionImportMappingResultMappingType $resultMapping)
    {
        $msg = null;
        if (!$resultMapping->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->resultMapping[] = $resultMapping;
        return $this;
    }

    /**
     * isset resultMapping
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetResultMapping($index)
    {
        return isset($this->resultMapping[$index]);
    }

    /**
     * unset resultMapping
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetResultMapping($index)
    {
        unset($this->resultMapping[$index]);
    }

    /**
     * Gets as resultMapping
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TFunctionImportMappingResultMappingType[]
     */
    public function getResultMapping()
    {
        return $this->resultMapping;
    }

    /**
     * Sets a new resultMapping
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TFunctionImportMappingResultMappingType[]
     * $resultMapping
     * @return self
     */
    public function setResultMapping(array $resultMapping)
    {
        $msg = null;
        if (!$this->isValidArrayOK(
            $resultMapping,
            '\AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TFunctionImportMappingResultMappingType',
            $msg
        )
        ) {
            throw new \InvalidArgumentException($msg);
        }
        $this->resultMapping = $resultMapping;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (!$this->isStringNotNullOrEmpty($this->functionName)) {
            $msg = 'Function name cannot be null or empty';
            return false;
        }
        if (!$this->isStringNotNullOrEmpty($this->functionImportName)) {
            $msg = 'Function import name cannot be null or empty';
            return false;
        }
        if (!$this->isTSimpleIdentifierValid($this->functionImportName)) {
            $msg = 'Function import name must be a valid TSimpleIdentifier';
            return false;
        }
        if (!$this->isValidArray(
            $this->resultMapping,
            '\AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TFunctionImportMappingResultMappingType'
        )
        ) {
            $msg = "Result mapping not a valid array";
            return false;
        }
        if (!$this->isChildArrayOK($this->resultMapping, $msg)) {
            return false;
        }
        return true;
    }
}
