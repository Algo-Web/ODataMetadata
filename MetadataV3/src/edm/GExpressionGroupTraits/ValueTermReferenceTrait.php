<?php
namespace AlgoWeb\ODataMetadata\MetadataV3\edm\GExpressionGroupTraits;

/**
 * Trait representing the ValueTermReference Component of  MetadataV3\edm\TCollectionExpressionType
 *
 *
 * XSD Type: GExpression
 */
trait ValueTermReferenceTrait
{
    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TValueTermReferenceExpressionType[]
     * $valueTermReference
     */
    private $valueTermReference = array(
        
    );

    
    /**
     * Adds as valueTermReference
     *
     * @return self
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TValueTermReferenceExpressionType $valueTermReference
     */
    public function addToValueTermReference(TValueTermReferenceExpressionType $valueTermReference)
    {
        $this->valueTermReference[] = $valueTermReference;
        return $this;
    }

    /**
     * isset valueTermReference
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetValueTermReference($index)
    {
        return isset($this->valueTermReference[$index]);
    }

    /**
     * unset valueTermReference
     *
     * @param scalar $index
     * @return void
     */
    public function unsetValueTermReference($index)
    {
        unset($this->valueTermReference[$index]);
    }

    /**
     * Gets as valueTermReference
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TValueTermReferenceExpressionType[]
     */
    public function getValueTermReference()
    {
        return $this->valueTermReference;
    }

    /**
     * Sets a new valueTermReference
     *
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TValueTermReferenceExpressionType[] $valueTermReference
     * @return self
     */
    public function setValueTermReference(array $valueTermReference)
    {
        $this->valueTermReference = $valueTermReference;
        return $this;
    }
}
