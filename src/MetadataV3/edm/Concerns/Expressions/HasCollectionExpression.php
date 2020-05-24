<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\Expressions;


use AlgoWeb\ODataMetadata\MetadataV3\Edm\Expressions\Dynamic\TCollectionExpressionType;

trait HasCollectionExpression
{
    /**
     * @var TCollectionExpressionType[] $collection
     */
    private $collection = [

    ];
    /**
     * Adds as collection
     *
     * @param TCollectionExpressionType $collection
     *@return self
     */
    public function addToCollection(TCollectionExpressionType $collection)
    {
        $this->collection[] = $collection;
        return $this;
    }

    /**
     * isset collection
     *
     * @param int|string $index
     * @return bool
     */
    public function issetCollection($index)
    {
        return isset($this->collection[$index]);
    }

    /**
     * unset collection
     *
     * @param int|string $index
     * @return void
     */
    public function unsetCollection($index)
    {
        unset($this->collection[$index]);
    }

    /**
     * Gets as collection
     *
     * @return TCollectionExpressionType[]
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * Sets a new collection
     *
     * @param TCollectionExpressionType[] $collection
     * @return self
     */
    public function setCollection(array $collection)
    {
        $this->collection = $collection;
        return $this;
    }
}