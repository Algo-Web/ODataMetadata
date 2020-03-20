<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Expressions\Dynamic\TAnonymousFunctionExpressionType;

use AlgoWeb\ODataMetadata\MetadataV3\Edm\ModelFunctionParameter;

/**
 * Class representing ParametersAType.
 */
class ParametersAType
{

    /**
     * @var ModelFunctionParameter[] $parameter
     */
    private $parameter = [
        
    ];

    /**
     * Adds as parameter.
     *
     * @param  ModelFunctionParameter $parameter
     * @return self
     */
    public function addToParameter(ModelFunctionParameter $parameter)
    {
        $this->parameter[] = $parameter;
        return $this;
    }

    /**
     * isset parameter.
     *
     * @param  int|string $index
     * @return bool
     */
    public function issetParameter($index)
    {
        return isset($this->parameter[$index]);
    }

    /**
     * unset parameter.
     *
     * @param  int|string $index
     * @return void
     */
    public function unsetParameter($index)
    {
        unset($this->parameter[$index]);
    }

    /**
     * Gets as parameter.
     *
     * @return ModelFunctionParameter[]
     */
    public function getParameter()
    {
        return $this->parameter;
    }

    /**
     * Sets a new parameter.
     *
     * @param  ModelFunctionParameter[] $parameter
     * @return self
     */
    public function setParameter(array $parameter)
    {
        $this->parameter = $parameter;
        return $this;
    }
}
