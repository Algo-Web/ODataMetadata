<?php
namespace MetadataV3\edm\TCollectionExpressionTypeTraits;

/**
 * Trait representing the PropertyReference Component of  MetadataV3\edm\TCollectionExpressionType
 *
 *
 * XSD Type: TCollectionExpression
 */
trait PropertyReferenceTrait
{

  


    
    /**
     * Adds as propertyReference
     *
     * @return self
     * @param \MetadataV3\edm\TPropertyReferenceExpressionType $propertyReference
     */
    public function addToPropertyReference(\MetadataV3\edm\TPropertyReferenceExpressionType $propertyReference)
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
     * @return \MetadataV3\edm\TPropertyReferenceExpressionType[]
     */
    public function getPropertyReference()
    {
        return $this->propertyReference;
    }

    /**
     * Sets a new propertyReference
     *
     * @param \MetadataV3\edm\TPropertyReferenceExpressionType[] $propertyReference
     * @return self
     */
    public function setPropertyReference(array $propertyReference)
    {
        $this->propertyReference = $propertyReference;
        return $this;
    }


}
