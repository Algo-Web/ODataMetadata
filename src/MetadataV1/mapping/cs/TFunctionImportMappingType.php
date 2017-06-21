<?php

namespace AlgoWeb\ODataMetadata\MetadataV1\mapping\cs;

use AlgoWeb\ODataMetadata\IsOK;

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
     * @property \AlgoWeb\ODataMetadata\MetadataV1\mapping\cs\TFunctionImportEntityTypeMappingType[]
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
     * Adds as entityTypeMapping
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV1\mapping\cs\TFunctionImportEntityTypeMappingType
     * $entityTypeMapping
     */
    public function addToResultMapping(TFunctionImportEntityTypeMappingType $entityTypeMapping)
    {
        $this->resultMapping[] = $entityTypeMapping;
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
     * @return \AlgoWeb\ODataMetadata\MetadataV1\mapping\cs\TFunctionImportEntityTypeMappingType[]
     */
    public function getResultMapping()
    {
        return $this->resultMapping;
    }

    /**
     * Sets a new resultMapping
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV1\mapping\cs\TFunctionImportEntityTypeMappingType[]
     * $resultMapping
     * @return self
     */
    public function setResultMapping(array $resultMapping)
    {
        $this->resultMapping = $resultMapping;
        return $this;
    }
}
