<?php
namespace AlgoWeb\ODataMetadata\MetadataV3\edm\GExpressionGroupTraits;

/**
 * Trait representing the DateTime Component of  MetadataV3\edm\TCollectionExpressionType
 *
 *
 * XSD Type: GExpression
 */
trait DateTimeTrait
{
    /**
     * @property \DateTime[] $dateTime
     */
    private $dateTime = array(
        
    );
    
    /**
     * Adds as dateTime
     *
     * @return self
     * @param \DateTime $dateTime
     */
    public function addToDateTime(\DateTime $dateTime)
    {
        $this->dateTime[] = $dateTime;
        return $this;
    }

    /**
     * isset dateTime
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetDateTime($index)
    {
        return isset($this->dateTime[$index]);
    }

    /**
     * unset dateTime
     *
     * @param scalar $index
     * @return void
     */
    public function unsetDateTime($index)
    {
        unset($this->dateTime[$index]);
    }

    /**
     * Gets as dateTime
     *
     * @return \DateTime[]
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }

    /**
     * Sets a new dateTime
     *
     * @param \DateTime $dateTime
     * @return self
     */
    public function setDateTime(array $dateTime)
    {
        $this->dateTime = $dateTime;
        return $this;
    }
}
