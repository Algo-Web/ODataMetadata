<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\Expressions;


use AlgoWeb\ODataMetadata\MetadataV3\Edm\Expressions\Dynamic\AssertTypeExpression;

trait HasTypeAssertExpression
{
    /**
     * @var AssertTypeExpression[] $typeAssert
     */
    private $typeAssert = [

    ];

    /**
     * Adds as typeAssert
     *
     * @param AssertTypeExpression $typeAssert
     *@return self
     */
    public function addToTypeAssert(AssertTypeExpression $typeAssert)
    {
        $this->typeAssert[] = $typeAssert;
        return $this;
    }

    /**
     * isset typeAssert
     *
     * @param int|string $index
     * @return bool
     */
    public function issetTypeAssert($index)
    {
        return isset($this->typeAssert[$index]);
    }

    /**
     * unset typeAssert
     *
     * @param int|string $index
     * @return void
     */
    public function unsetTypeAssert($index)
    {
        unset($this->typeAssert[$index]);
    }

    /**
     * Gets as typeAssert
     *
     * @return AssertTypeExpression[]
     */
    public function getTypeAssert()
    {
        return $this->typeAssert;
    }

    /**
     * Sets a new typeAssert
     *
     * @param AssertTypeExpression[] $typeAssert
     * @return self
     */
    public function setTypeAssert(array $typeAssert)
    {
        $this->typeAssert = $typeAssert;
        return $this;
    }
}