<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\Expressions;


use AlgoWeb\ODataMetadata\MetadataV3\Edm\Expressions\Dynamic\TParameterReferenceExpressionType;

trait HasParameterReferenceExpression
{
    /**
     * @var TParameterReferenceExpressionType[] $parameterReference
     */
    private $parameterReference = [

    ];

    /**
     * Adds as parameterReference
     *
     * @param TParameterReferenceExpressionType $parameterReference
     *@return self
     */
    public function addToParameterReference(TParameterReferenceExpressionType $parameterReference)
    {
        $this->parameterReference[] = $parameterReference;
        return $this;
    }

    /**
     * isset parameterReference
     *
     * @param int|string $index
     * @return bool
     */
    public function issetParameterReference($index)
    {
        return isset($this->parameterReference[$index]);
    }

    /**
     * unset parameterReference
     *
     * @param int|string $index
     * @return void
     */
    public function unsetParameterReference($index)
    {
        unset($this->parameterReference[$index]);
    }

    /**
     * Gets as parameterReference
     *
     * @return TParameterReferenceExpressionType[]
     */
    public function getParameterReference()
    {
        return $this->parameterReference;
    }

    /**
     * Sets a new parameterReference
     *
     * @param TParameterReferenceExpressionType[] $parameterReference
     * @return self
     */
    public function setParameterReference(array $parameterReference)
    {
        $this->parameterReference = $parameterReference;
        return $this;
    }
}