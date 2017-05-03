<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Groups\GExpressionTrait;

/**
 * Class representing TAnonymousFunctionExpressionType
 *
 *
 * XSD Type: TAnonymousFunctionExpression
 */
class TAnonymousFunctionExpressionType extends IsOK
{
    use GExpressionTrait;
    
    public function __construct()
    {
        $this->gExpressionMaximum = 1;
    }
    
    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionParameterType[] $parameters
     */
    private $parameters = null;

    /**
     * Adds as parameter
     *
     * @return self
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionParameterType $parameter
     */
    public function addToParameters(TFunctionParameterType $parameter)
    {
        $this->parameters[] = $parameter;
        return $this;
    }

    /**
     * isset parameters
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetParameters($index)
    {
        return isset($this->parameters[$index]);
    }

    /**
     * unset parameters
     *
     * @param scalar $index
     * @return void
     */
    public function unsetParameters($index)
    {
        unset($this->parameters[$index]);
    }

    /**
     * Gets as parameters
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionParameterType[]
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * Sets a new parameters
     *
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionParameterType[] $parameters
     * @return self
     */
    public function setParameters(array $parameters)
    {
        $this->parameters = $parameters;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (!$this->isGExpressionValid($msg)) {
            return false;
        }
        return true;
    }
}
