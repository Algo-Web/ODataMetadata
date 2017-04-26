<?php
namespace MetadataV3\edm\GExpressionGroupTraits;

/**
 * Trait representing the Float Component of  MetadataV3\edm\TCollectionExpressionType
 *
 *
 * XSD Type: GExpression
 */
trait FloatTrait
{
    /**
     * @property float[] $float
     */
    private $float = array(
        
    );

    
    /**
     * Adds as float
     *
     * @return self
     * @param float $float
     */
    public function addToFloat($float)
    {
        $this->float[] = $float;
        return $this;
    }

    /**
     * isset float
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetFloat($index)
    {
        return isset($this->float[$index]);
    }

    /**
     * unset float
     *
     * @param scalar $index
     * @return void
     */
    public function unsetFloat($index)
    {
        unset($this->float[$index]);
    }

    /**
     * Gets as float
     *
     * @return float[]
     */
    public function getFloat()
    {
        return $this->float;
    }

    /**
     * Sets a new float
     *
     * @param float $float
     * @return self
     */
    public function setFloat(array $float)
    {
        $this->float = $float;
        return $this;
    }
}
