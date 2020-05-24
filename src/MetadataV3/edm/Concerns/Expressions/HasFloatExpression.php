<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\Expressions;

trait HasFloatExpression
{
    /**
     * @var float[] $float
     */
    private $float = [

    ];


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
     * @param int|string $index
     * @return bool
     */
    public function issetFloat($index)
    {
        return isset($this->float[$index]);
    }

    /**
     * unset float
     *
     * @param int|string $index
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
     * @param float[] $float
     * @return self
     */
    public function setFloat(array $float)
    {
        $this->float = $float;
        return $this;
    }
}
