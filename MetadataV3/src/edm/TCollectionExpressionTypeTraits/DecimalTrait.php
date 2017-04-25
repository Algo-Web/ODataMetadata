<?php
namespace MetadataV3\edm\TCollectionExpressionTypeTraits;

/**
 * Trait representing the Decimal Component of  MetadataV3\edm\TCollectionExpressionType
 *
 *
 * XSD Type: TCollectionExpression
 */
trait DecimalTrait
{
    /**
     * @property float[] $decimal
     */
    private $decimal = array(
        
    );
    
    /**
     * Adds as decimal
     *
     * @return self
     * @param float $decimal
     */
    public function addToDecimal($decimal)
    {
        $this->decimal[] = $decimal;
        return $this;
    }

    /**
     * isset decimal
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetDecimal($index)
    {
        return isset($this->decimal[$index]);
    }

    /**
     * unset decimal
     *
     * @param scalar $index
     * @return void
     */
    public function unsetDecimal($index)
    {
        unset($this->decimal[$index]);
    }

    /**
     * Gets as decimal
     *
     * @return float[]
     */
    public function getDecimal()
    {
        return $this->decimal;
    }

    /**
     * Sets a new decimal
     *
     * @param float $decimal
     * @return self
     */
    public function setDecimal(array $decimal)
    {
        $this->decimal = $decimal;
        return $this;
    }
}
