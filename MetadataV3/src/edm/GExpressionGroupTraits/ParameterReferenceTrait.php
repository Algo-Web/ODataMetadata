<?php
namespace AlgoWeb\ODataMetadata\MetadataV3\edm\GExpressionGroupTraits;

/**
 * Trait representing the ParameterReference Component of  MetadataV3\edm\TCollectionExpressionType
 *
 *
 * XSD Type: GExpression
 */
trait ParameterReferenceTrait
{


    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TParameterReferenceExpressionType[]
     * $parameterReference
     */
    private $parameterReference = array(
        
    );

    
    /**
     * Adds as parameterReference
     *
     * @return self
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TParameterReferenceExpressionType $parameterReference
     */
    public function addToParameterReference(TParameterReferenceExpressionType $parameterReference)
    {
        $this->parameterReference[] = $parameterReference;
        return $this;
    }

    /**
     * isset parameterReference
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetParameterReference($index)
    {
        return isset($this->parameterReference[$index]);
    }

    /**
     * unset parameterReference
     *
     * @param scalar $index
     * @return void
     */
    public function unsetParameterReference($index)
    {
        unset($this->parameterReference[$index]);
    }

    /**
     * Gets as parameterReference
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TParameterReferenceExpressionType[]
     */
    public function getParameterReference()
    {
        return $this->parameterReference;
    }

    /**
     * Sets a new parameterReference
     *
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TParameterReferenceExpressionType[] $parameterReference
     * @return self
     */
    public function setParameterReference(array $parameterReference)
    {
        $this->parameterReference = $parameterReference;
        return $this;
    }
}
