<?php
namespace AlgoWeb\ODataMetadata\MetadataV3\edm\GExpressionGroupTraits;

/**
 * Trait representing the EntitySetReference Component of  MetadataV3\edm\TCollectionExpressionType
 *
 *
 * XSD Type: GExpression
 */
trait EntitySetReferenceTrait
{
    /**
     * @property \MetadataV3\edm\TEntitySetReferenceExpressionType[]
     * $entitySetReference
     */
    private $entitySetReference = array(
        
    );

    
    /**
     * Adds as entitySetReference
     *
     * @return self
     * @param \MetadataV3\edm\TEntitySetReferenceExpressionType $entitySetReference
     */
    public function addToEntitySetReference(\MetadataV3\edm\TEntitySetReferenceExpressionType $entitySetReference)
    {
        $this->entitySetReference[] = $entitySetReference;
        return $this;
    }

    /**
     * isset entitySetReference
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetEntitySetReference($index)
    {
        return isset($this->entitySetReference[$index]);
    }

    /**
     * unset entitySetReference
     *
     * @param scalar $index
     * @return void
     */
    public function unsetEntitySetReference($index)
    {
        unset($this->entitySetReference[$index]);
    }

    /**
     * Gets as entitySetReference
     *
     * @return \MetadataV3\edm\TEntitySetReferenceExpressionType[]
     */
    public function getEntitySetReference()
    {
        return $this->entitySetReference;
    }

    /**
     * Sets a new entitySetReference
     *
     * @param \MetadataV3\edm\TEntitySetReferenceExpressionType[] $entitySetReference
     * @return self
     */
    public function setEntitySetReference(array $entitySetReference)
    {
        $this->entitySetReference = $entitySetReference;
        return $this;
    }
}
