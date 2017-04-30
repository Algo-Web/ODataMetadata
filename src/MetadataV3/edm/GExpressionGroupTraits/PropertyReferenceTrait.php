<?php
namespace AlgoWeb\ODataMetadata\MetadataV3\edm\GExpressionGroupTraits;

/**
 * Trait representing the PropertyReference Component of  MetadataV3\edm\TCollectionExpressionType
 *
 *
 * XSD Type: GExpression
 */
trait PropertyReferenceTrait
{

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyReferenceExpressionType[] $propertyReference
     */
    private $propertyReference = array(
        
    );


    
    /**
     * Adds as propertyReference
     *
     * @return self
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyReferenceExpressionType $propertyReference
     */
    public function addToPropertyReference(TPropertyReferenceExpressionType $propertyReference)
    {
        $this->propertyReference[] = $propertyReference;
        return $this;
    }

    /**
     * isset propertyReference
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetPropertyReference($index)
    {
        return isset($this->propertyReference[$index]);
    }

    /**
     * unset propertyReference
     *
     * @param scalar $index
     * @return void
     */
    public function unsetPropertyReference($index)
    {
        unset($this->propertyReference[$index]);
    }

    /**
     * Gets as propertyReference
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyReferenceExpressionType[]
     */
    public function getPropertyReference()
    {
        return $this->propertyReference;
    }

    /**
     * Sets a new propertyReference
     *
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyReferenceExpressionType[] $propertyReference
     * @return self
     */
    public function setPropertyReference(array $propertyReference)
    {
        $this->propertyReference = $propertyReference;
        return $this;
    }
}
