<?php
namespace AlgoWeb\ODataMetadata\MetadataV3\edm\GExpressionGroupTraits;

/**
 * Trait representing the Collection Component of  MetadataV3\edm\TCollectionExpressionType
 *
 *
 * XSD Type: GExpression
 */
trait CollectionTrait
{
    /**
     * @property \MetadataV3\edm\TCollectionExpressionType[] $collection
     */
    private $collection = array(
        
    );
    
    /**
     * Adds as collection
     *
     * @return self
     * @param \MetadataV3\edm\TCollectionExpressionType $collection
     */
    public function addToCollection(\MetadataV3\edm\TCollectionExpressionType $collection)
    {
        $this->collection[] = $collection;
        return $this;
    }

    /**
     * isset collection
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetCollection($index)
    {
        return isset($this->collection[$index]);
    }

    /**
     * unset collection
     *
     * @param scalar $index
     * @return void
     */
    public function unsetCollection($index)
    {
        unset($this->collection[$index]);
    }

    /**
     * Gets as collection
     *
     * @return \MetadataV3\edm\TCollectionExpressionType[]
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * Sets a new collection
     *
     * @param \MetadataV3\edm\TCollectionExpressionType[] $collection
     * @return self
     */
    public function setCollection(array $collection)
    {
        $this->collection = $collection;
        return $this;
    }
}
