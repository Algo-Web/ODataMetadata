<?php
namespace AlgoWeb\ODataMetadata\MetadataV3\edm\GExpressionGroupTraits;

/**
 * Trait representing the FunctionReference Component of  MetadataV3\edm\TCollectionExpressionType
 *
 *
 * XSD Type: GExpression
 */
trait FunctionReferenceTrait
{
    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionReferenceExpressionType[] $functionReference
     */
    private $functionReference = array(
        
    );
    
    /**
     * Adds as functionReference
     *
     * @return self
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionReferenceExpressionType $functionReference
     */
    public function addToFunctionReference(TFunctionReferenceExpressionType $functionReference)
    {
        $this->functionReference[] = $functionReference;
        return $this;
    }

    /**
     * isset functionReference
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetFunctionReference($index)
    {
        return isset($this->functionReference[$index]);
    }

    /**
     * unset functionReference
     *
     * @param scalar $index
     * @return void
     */
    public function unsetFunctionReference($index)
    {
        unset($this->functionReference[$index]);
    }

    /**
     * Gets as functionReference
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionReferenceExpressionType[]
     */
    public function getFunctionReference()
    {
        return $this->functionReference;
    }

    /**
     * Sets a new functionReference
     *
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionReferenceExpressionType[] $functionReference
     * @return self
     */
    public function setFunctionReference(array $functionReference)
    {
        $this->functionReference = $functionReference;
        return $this;
    }
}
