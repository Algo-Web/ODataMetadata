<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\TAnonymousFunctionExpressionType;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\IsOKTraits\IsOKToolboxTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionParameterType;

/**
 * Class representing ParametersAnonymousType
 */
class ParametersAnonymousType extends IsOK
{
    use IsOKToolboxTrait;
    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionParameterType[] $parameter
     */
    private $parameter = [];

    /**
     * Adds as parameter
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionParameterType $parameter
     */
    public function addToParameter(TFunctionParameterType $parameter)
    {
        $msg = null;
        if (!$parameter->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->parameter[] = $parameter;
        return $this;
    }

    /**
     * isset parameter
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetParameter($index)
    {
        return isset($this->parameter[$index]);
    }

    /**
     * unset parameter
     *
     * @param  scalar $index
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
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionParameterType[] $parameter
     * @return self
     */
    public function setParameter(array $parameter)
    {
        $msg = null;
        if (!$this->isValidArrayOK(
            $parameter,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionParameterType',
            $msg
        )
        ) {
            throw new \InvalidArgumentException($msg);
        };
        $this->parameter = $parameter;
        return $this;
    }
    
    public function isOK(&$msg = null)
    {
        return !$this->isValidArrayOK(
            $this->parameter,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionParameterType',
            $msg
        );
    }
}
