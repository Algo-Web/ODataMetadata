<?php


namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\Expressions;

use AlgoWeb\ODataMetadata\MetadataV3\Edm\Expressions\Dynamic\IsTypeExpression;

trait HasTypeTestExpression
{
    /**
     * @var IsTypeExpression[] $typeTest
     */
    private $typeTest = [

    ];

    /**
     * Adds as typeTest.
     *
     * @param IsTypeExpression $typeTest
     *@return self
     */
    public function addToTypeTest(IsTypeExpression $typeTest)
    {
        $this->typeTest[] = $typeTest;
        return $this;
    }



    /**
     * isset typeTest.
     *
     * @param  int|string $index
     * @return bool
     */
    public function issetTypeTest($index)
    {
        return isset($this->typeTest[$index]);
    }

    /**
     * unset typeTest.
     *
     * @param  int|string $index
     * @return void
     */
    public function unsetTypeTest($index)
    {
        unset($this->typeTest[$index]);
    }

    /**
     * Gets as typeTest.
     *
     * @return IsTypeExpression[]
     */
    public function getTypeTest()
    {
        return $this->typeTest;
    }

    /**
     * Sets a new typeTest.
     *
     * @param  IsTypeExpression[] $typeTest
     * @return self
     */
    public function setTypeTest(array $typeTest)
    {
        $this->typeTest = $typeTest;
        return $this;
    }
}
