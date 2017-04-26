<?php
namespace MetadataV3\edm\GExpressionGroupTraits;

/**
 * Trait representing the DateTimeOffset Component of  MetadataV3\edm\TCollectionExpressionType
 *
 *
 * XSD Type: GExpression
 */
trait DateTimeOffsetTrait
{

    /**
     * @property \DateTime[] $dateTimeOffset
     */
    private $dateTimeOffset = array(
        
    );
    

    /**
     * Adds as dateTimeOffset
     *
     * @return self
     * @param \DateTime $dateTimeOffset
     */
    public function addToDateTimeOffset(\DateTime $dateTimeOffset)
    {
        $this->dateTimeOffset[] = $dateTimeOffset;
        return $this;
    }

    /**
     * isset dateTimeOffset
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetDateTimeOffset($index)
    {
        return isset($this->dateTimeOffset[$index]);
    }

    /**
     * unset dateTimeOffset
     *
     * @param scalar $index
     * @return void
     */
    public function unsetDateTimeOffset($index)
    {
        unset($this->dateTimeOffset[$index]);
    }

    /**
     * Gets as dateTimeOffset
     *
     * @return \DateTime[]
     */
    public function getDateTimeOffset()
    {
        return $this->dateTimeOffset;
    }

    /**
     * Sets a new dateTimeOffset
     *
     * @param \DateTime $dateTimeOffset
     * @return self
     */
    public function setDateTimeOffset(array $dateTimeOffset)
    {
        $this->dateTimeOffset = $dateTimeOffset;
        return $this;
    }
}
