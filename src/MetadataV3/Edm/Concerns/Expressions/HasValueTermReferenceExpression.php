<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\Expressions;

use AlgoWeb\ODataMetadata\MetadataV3\Edm\Expressions\Dynamic\TValueTermReferenceExpressionType;

trait HasValueTermReferenceExpression
{
    /**
     * @var TValueTermReferenceExpressionType[] $valueTermReference
     */
    private $valueTermReference = [

    ];

    /**
     * Adds as valueTermReference.
     *
     * @param TValueTermReferenceExpressionType $valueTermReference
     *@return self
     */
    public function addToValueTermReference(TValueTermReferenceExpressionType $valueTermReference)
    {
        $this->valueTermReference[] = $valueTermReference;
        return $this;
    }

    /**
     * isset valueTermReference.
     *
     * @param  int|string $index
     * @return bool
     */
    public function issetValueTermReference($index)
    {
        return isset($this->valueTermReference[$index]);
    }

    /**
     * unset valueTermReference.
     *
     * @param  int|string $index
     * @return void
     */
    public function unsetValueTermReference($index)
    {
        unset($this->valueTermReference[$index]);
    }

    /**
     * Gets as valueTermReference.
     *
     * @return TValueTermReferenceExpressionType[]
     */
    public function getValueTermReference()
    {
        return $this->valueTermReference;
    }

    /**
     * Sets a new valueTermReference.
     *
     * @param  TValueTermReferenceExpressionType[] $valueTermReference
     * @return self
     */
    public function setValueTermReference(array $valueTermReference)
    {
        $this->valueTermReference = $valueTermReference;
        return $this;
    }
}
