<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\Expressions;


use AlgoWeb\ODataMetadata\MetadataV3\Edm\Expressions\Dynamic\TEntitySetReferenceExpressionType;

trait HasEntitySetReferenceExpression
{
    /**
     * @var TEntitySetReferenceExpressionType[] $entitySetReference
     */
    private $entitySetReference = [

    ];

    /**
     * Adds as entitySetReference
     *
     * @param TEntitySetReferenceExpressionType $entitySetReference
     *@return self
     */
    public function addToEntitySetReference(TEntitySetReferenceExpressionType $entitySetReference)
    {
        $this->entitySetReference[] = $entitySetReference;
        return $this;
    }

    /**
     * isset entitySetReference
     *
     * @param int|string $index
     * @return bool
     */
    public function issetEntitySetReference($index)
    {
        return isset($this->entitySetReference[$index]);
    }

    /**
     * unset entitySetReference
     *
     * @param int|string $index
     * @return void
     */
    public function unsetEntitySetReference($index)
    {
        unset($this->entitySetReference[$index]);
    }

    /**
     * Gets as entitySetReference
     *
     * @return TEntitySetReferenceExpressionType[]
     */
    public function getEntitySetReference()
    {
        return $this->entitySetReference;
    }

    /**
     * Sets a new entitySetReference
     *
     * @param TEntitySetReferenceExpressionType[] $entitySetReference
     * @return self
     */
    public function setEntitySetReference(array $entitySetReference)
    {
        $this->entitySetReference = $entitySetReference;
        return $this;
    }

}