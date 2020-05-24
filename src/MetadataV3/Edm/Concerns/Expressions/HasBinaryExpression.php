<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\Expressions;

trait HasBinaryExpression
{
    /**
     * @var mixed[] $binary
     */
    private $binary = [

    ];



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
     * @param int|string $index
     * @return bool
     */
    public function issetBinary($index)
    {
        return isset($this->binary[$index]);
    }

    /**
     * unset binary
     *
     * @param int|string $index
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
