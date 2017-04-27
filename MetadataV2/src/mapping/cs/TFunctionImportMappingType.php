<?php

namespace AlgoWeb\ODataMetadata\MetadataV2\mapping\cs;

/**
 * Class representing TFunctionImportMappingType
 *
 *
 * XSD Type: TFunctionImportMapping
 */
class TFunctionImportMappingType
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
     * @property \MetadataV2\mapping\cs\TFunctionImportMappingResultMappingType
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
     * @param string $functionName
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
     * @param string $functionImportName
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
     * @return \MetadataV2\mapping\cs\TFunctionImportMappingResultMappingType
     */
    public function getResultMapping()
    {
        return $this->resultMapping;
    }

    /**
     * Sets a new resultMapping
     *
     * @param \MetadataV2\mapping\cs\TFunctionImportMappingResultMappingType
     * $resultMapping
     * @return self
     */
    public function setResultMapping(\MetadataV2\mapping\cs\TFunctionImportMappingResultMappingType $resultMapping)
    {
        $this->resultMapping = $resultMapping;
        return $this;
    }
}
