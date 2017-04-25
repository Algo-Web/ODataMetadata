<?php
namespace MetadataV3\edm\TCollectionExpressionTypeTraits;

/**
 * Trait representing the binary Component of  MetadataV3\edm\TCollectionExpressionType
 *
 *
 * XSD Type: TCollectionExpression
 */
trait BinaryTrait
{
    /**
     * @property mixed[] $binary
     */
    private $binary = array(
        
    );

    

    /**
     * Adds as binary
     *
     * @return self
     * @param mixed $binary
     */
    public function addToBinary($binary)
    {
        $this->binary[] = $binary;
        return $this;
    }

    /**
     * isset binary
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetBinary($index)
    {
        return isset($this->binary[$index]);
    }

    /**
     * unset binary
     *
     * @param scalar $index
     * @return void
     */
    public function unsetBinary($index)
    {
        unset($this->binary[$index]);
    }

    /**
     * Gets as binary
     *
     * @return mixed[]
     */
    public function getBinary()
    {
        return $this->binary;
    }

    /**
     * Sets a new binary
     *
     * @param mixed $binary
     * @return self
     */
    public function setBinary(array $binary)
    {
        $this->binary = $binary;
        return $this;
    }
}
