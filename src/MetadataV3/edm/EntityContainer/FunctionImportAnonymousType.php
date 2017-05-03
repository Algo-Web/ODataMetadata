<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\EntityContainer;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Groups\TFunctionImportAttributesTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TDocumentationType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionImportParameterType;

/**
 * Class representing FunctionImportAnonymousType
 */
class FunctionImportAnonymousType extends IsOK
{
    use TFunctionImportAttributesTrait;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TDocumentationType $documentation
     */
    private $documentation = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionImportParameterType[] $parameter
     */
    private $parameter = [];

    /**
     * Gets as documentation
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TDocumentationType
     */
    public function getDocumentation()
    {
        return $this->documentation;
    }

    /**
     * Sets a new documentation
     *
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TDocumentationType $documentation
     * @return self
     */
    public function setDocumentation(TDocumentationType $documentation)
    {
        $this->documentation = $documentation;
        return $this;
    }

    /**
     * Adds as parameter
     *
     * @return self
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionImportParameterType $parameter
     */
    public function addToParameter(TFunctionImportParameterType $parameter)
    {
        $this->parameter[] = $parameter;
        return $this;
    }

    /**
     * isset parameter
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetParameter($index)
    {
        return isset($this->parameter[$index]);
    }

    /**
     * unset parameter
     *
     * @param scalar $index
     * @return void
     */
    public function unsetParameter($index)
    {
        unset($this->parameter[$index]);
    }

    /**
     * Gets as parameter
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionImportParameterType[]
     */
    public function getParameter()
    {
        return $this->parameter;
    }

    /**
     * Sets a new parameter
     *
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionImportParameterType[] $parameter
     * @return self
     */
    public function setParameter(array $parameter)
    {
        $this->parameter = $parameter;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (!$this->isTFunctionImportAttributesValid($msg)) {
            return false;
        }
        return true;
    }
}
