<?php

namespace AlgoWeb\ODataMetadata\MetadataV2\mapping\cs;

/**
 * Class representing TFunctionImportMappingType
 *
 * XSD Type: TFunctionImportMapping
 */
class TFunctionImportMappingType extends IsOK
{

    /**
     * @property string $functionName
     */
    private $functionName = null;

    /**
     * @property string $functionImportName
     */
    private $functionImportName = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV2\mapping\cs\TFunctionImportMappingResultMappingType
     * $resultMapping
     */
    private $resultMapping = null;

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
        $this->functionImportName = $functionImportName;
        return $this;
    }

    /**
     * Gets as resultMapping
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV2\mapping\cs\TFunctionImportMappingResultMappingType
     */
    public function getResultMapping()
    {
        return $this->resultMapping;
    }

    /**
     * Sets a new resultMapping
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV2\mapping\cs\TFunctionImportMappingResultMappingType
     * $resultMapping
     * @return self
     */
    public function setResultMapping(TFunctionImportMappingResultMappingType $resultMapping)
    {
        $this->resultMapping = $resultMapping;
        return $this;
    }
}
