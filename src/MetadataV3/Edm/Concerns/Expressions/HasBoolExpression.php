<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\Expressions;

trait HasBoolExpression
{
    /**
     * @var bool[] $bool
     */
    private $bool = [

    ];


    /**
     * Adds as bool
     *
     * @return self
     * @param bool $bool
     */
    public function addToBool($bool)
    {
        $this->bool[] = $bool;
        return $this;
    }

    /**
     * isset bool
     *
     * @param int|string $index
     * @return bool
     */
    public function issetBool($index)
    {
        return isset($this->bool[$index]);
    }

    /**
     * unset bool
     *
     * @param int|string $index
     * @return void
     */
    public function unsetBool($index)
    {
        unset($this->bool[$index]);
    }

    /**
     * Gets as bool
     *
     * @return bool[]
     */
    public function getBool()
    {
        return $this->bool;
    }

    /**
     * Sets a new bool
     *
     * @param bool[] $bool
     * @return self
     */
    public function setBool(array $bool)
    {
        $this->bool = $bool;
        return $this;
    }
}
