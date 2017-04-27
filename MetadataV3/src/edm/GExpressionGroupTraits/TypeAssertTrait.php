<?php
namespace AlgoWeb\ODataMetadata\MetadataV3\edm\GExpressionGroupTraits;

/**
 * Trait representing the TypeAssert Component of  MetadataV3\edm\TCollectionExpressionType
 *
 *
 * XSD Type: GExpression
 */
trait TypeAssertTrait
{
    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TTypeAssertExpressionType[] $typeAssert
     */
    private $typeAssert = array(
        
    );

    

    /**
     * Adds as typeAssert
     *
     * @return self
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TTypeAssertExpressionType $typeAssert
     */
    public function addToTypeAssert(TTypeAssertExpressionType $typeAssert)
    {
        $this->typeAssert[] = $typeAssert;
        return $this;
    }

    /**
     * isset typeAssert
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetTypeAssert($index)
    {
        return isset($this->typeAssert[$index]);
    }

    /**
     * unset typeAssert
     *
     * @param scalar $index
     * @return void
     */
    public function unsetTypeAssert($index)
    {
        unset($this->typeAssert[$index]);
    }

    /**
     * Gets as typeAssert
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TTypeAssertExpressionType[]
     */
    public function getTypeAssert()
    {
        return $this->typeAssert;
    }

    /**
     * Sets a new typeAssert
     *
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TTypeAssertExpressionType[] $typeAssert
     * @return self
     */
    public function setTypeAssert(array $typeAssert)
    {
        $this->typeAssert = $typeAssert;
        return $this;
    }
}
