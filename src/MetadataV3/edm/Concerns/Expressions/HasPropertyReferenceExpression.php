<?php


namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\Expressions;

use AlgoWeb\ODataMetadata\MetadataV3\Edm\Expressions\Dynamic\TPropertyReferenceExpressionType;

trait HasPropertyReferenceExpression
{
    /**
     * @var TPropertyReferenceExpressionType[] $propertyReference
     */
    private $propertyReference = [

    ];

    /**
     * Adds as propertyReference.
     *
     * @param TPropertyReferenceExpressionType $propertyReference
     *@return self
     */
    public function addToPropertyReference(TPropertyReferenceExpressionType $propertyReference)
    {
        $this->propertyReference[] = $propertyReference;
        return $this;
    }

    /**
     * isset propertyReference.
     *
     * @param  int|string $index
     * @return bool
     */
    public function issetPropertyReference($index)
    {
        return isset($this->propertyReference[$index]);
    }

    /**
     * unset propertyReference.
     *
     * @param  int|string $index
     * @return void
     */
    public function unsetPropertyReference($index)
    {
        unset($this->propertyReference[$index]);
    }

    /**
     * Gets as propertyReference.
     *
     * @return TPropertyReferenceExpressionType[]
     */
    public function getPropertyReference()
    {
        return $this->propertyReference;
    }

    /**
     * Sets a new propertyReference.
     *
     * @param  TPropertyReferenceExpressionType[] $propertyReference
     * @return self
     */
    public function setPropertyReference(array $propertyReference)
    {
        $this->propertyReference = $propertyReference;
        return $this;
    }
}
