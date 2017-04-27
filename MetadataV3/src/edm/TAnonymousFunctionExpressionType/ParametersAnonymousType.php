<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\TAnonymousFunctionExpressionType;

use AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionParameterType;

/**
 * Class representing ParametersAnonymousType
 */
class ParametersAnonymousType
{

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionParameterType[] $parameter
     */
    private $parameter = array(
        
    );

    /**
     * Adds as parameter
     *
     * @return self
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionParameterType $parameter
     */
    public function addToParameter(TFunctionParameterType $parameter)
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
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionParameterType[]
     */
    public function getParameter()
    {
        return $this->parameter;
    }

    /**
     * Sets a new parameter
     *
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionParameterType[] $parameter
     * @return self
     */
    public function setParameter(array $parameter)
    {
        $this->parameter = $parameter;
        return $this;
    }
}
