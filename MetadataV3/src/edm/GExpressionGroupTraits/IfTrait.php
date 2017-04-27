<?php
namespace AlgoWeb\ODataMetadata\MetadataV3\edm\GExpressionGroupTraits;

/**
 * Trait representing the If Component of  MetadataV3\edm\TCollectionExpressionType
 *
 *
 * XSD Type: GExpression
 */
trait IfTrait
{
    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TIfExpressionType[] $if
     */
    private $if = array(
        
    );
    
    /**
     * Adds as if
     *
     * @return self
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TIfExpressionType $if
     */
    public function addToIf(TIfExpressionType $if)
    {
        $this->if[] = $if;
        return $this;
    }

    /**
     * isset if
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetIf($index)
    {
        return isset($this->if[$index]);
    }

    /**
     * unset if
     *
     * @param scalar $index
     * @return void
     */
    public function unsetIf($index)
    {
        unset($this->if[$index]);
    }

    /**
     * Gets as if
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TIfExpressionType[]
     */
    public function getIf()
    {
        return $this->if;
    }

    /**
     * Sets a new if
     *
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TIfExpressionType[] $if
     * @return self
     */
    public function setIf(array $if)
    {
        $this->if = $if;
        return $this;
    }
}
