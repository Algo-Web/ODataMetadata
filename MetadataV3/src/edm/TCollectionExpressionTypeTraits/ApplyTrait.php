<?php
namespace MetadataV3\edm\TCollectionExpressionTypeTraits;

/**
 * Trait representing the Apply Component of  MetadataV3\edm\TCollectionExpressionType
 *
 *
 * XSD Type: TCollectionExpression
 */
trait ApplyTrait
{
    /**
     * @property \MetadataV3\edm\TApplyExpressionType[] $apply
     */
    private $apply = array(
        
    );

    /**
     * Adds as apply
     *
     * @return self
     * @param \MetadataV3\edm\TApplyExpressionType $apply
     */
    public function addToApply(\MetadataV3\edm\TApplyExpressionType $apply)
    {
        $this->apply[] = $apply;
        return $this;
    }

    /**
     * isset apply
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetApply($index)
    {
        return isset($this->apply[$index]);
    }

    /**
     * unset apply
     *
     * @param scalar $index
     * @return void
     */
    public function unsetApply($index)
    {
        unset($this->apply[$index]);
    }

    /**
     * Gets as apply
     *
     * @return \MetadataV3\edm\TApplyExpressionType[]
     */
    public function getApply()
    {
        return $this->apply;
    }

    /**
     * Sets a new apply
     *
     * @param \MetadataV3\edm\TApplyExpressionType[] $apply
     * @return self
     */
    public function setApply(array $apply)
    {
        $this->apply = $apply;
        return $this;
    }
}
