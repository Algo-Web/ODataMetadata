<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\Expressions;

trait HasIntExpression
{
    /**
     * @var int[] $int
     */
    private $int = [

    ];

    /**
     * Adds as int.
     *
     * @param  int  $int
     * @return self
     */
    public function addToInt($int)
    {
        $this->int[] = $int;
        return $this;
    }

    /**
     * isset int.
     *
     * @param  int|string $index
     * @return bool
     */
    public function issetInt($index)
    {
        return isset($this->int[$index]);
    }

    /**
     * unset int.
     *
     * @param  int|string $index
     * @return void
     */
    public function unsetInt($index)
    {
        unset($this->int[$index]);
    }

    /**
     * Gets as int.
     *
     * @return int[]
     */
    public function getInt()
    {
        return $this->int;
    }

    /**
     * Sets a new int.
     *
     * @param  int[] $int
     * @return self
     */
    public function setInt(array $int)
    {
        $this->int = $int;
        return $this;
    }
}
