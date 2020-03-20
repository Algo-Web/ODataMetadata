<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Expressions\Dynamic;

use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\HasExpression;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\ModelFunctionParameter;

/**
 * Class representing TAnonymousFunctionExpressionType.
 *
 *
 * XSD Type: TAnonymousFunctionExpression
 */
class TAnonymousFunctionExpressionType extends DynamicBase
{
    use HasExpression;

    /**
     * @var ModelFunctionParameter[] $parameters
     */
    private $parameters = null;

    /**
     * Adds as parameter.
     *
     * @param  ModelFunctionParameter $parameter
     * @return self
     */
    public function addToParameters(ModelFunctionParameter $parameter)
    {
        $this->parameters[] = $parameter;
        return $this;
    }

    /**
     * isset parameters.
     *
     * @param  int|string $index
     * @return bool
     */
    public function issetParameters($index)
    {
        return isset($this->parameters[$index]);
    }

    /**
     * unset parameters.
     *
     * @param  int|string $index
     * @return void
     */
    public function unsetParameters($index)
    {
        unset($this->parameters[$index]);
    }

    /**
     * Gets as parameters.
     *
     * @return ModelFunctionParameter[]
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * Sets a new parameters.
     *
     * @param  ModelFunctionParameter[] $parameters
     * @return self
     */
    public function setParameters(array $parameters)
    {
        $this->parameters = $parameters;
        return $this;
    }
}
