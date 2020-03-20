<?php


namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\Expressions;

use AlgoWeb\ODataMetadata\MetadataV3\Edm\Expressions\Dynamic\TAnonymousFunctionExpressionType;

trait HasAnonymousFunctionExpression
{
    /**
     * @var TAnonymousFunctionExpressionType[] $anonymousFunction
     */
    private $anonymousFunction = [

    ];


    /**
     * Adds as anonymousFunction.
     *
     * @param TAnonymousFunctionExpressionType $anonymousFunction
     *@return self
     */
    public function addToAnonymousFunction(TAnonymousFunctionExpressionType $anonymousFunction)
    {
        $this->anonymousFunction[] = $anonymousFunction;
        return $this;
    }

    /**
     * isset anonymousFunction.
     *
     * @param  int|string $index
     * @return bool
     */
    public function issetAnonymousFunction($index)
    {
        return isset($this->anonymousFunction[$index]);
    }

    /**
     * unset anonymousFunction.
     *
     * @param  int|string $index
     * @return void
     */
    public function unsetAnonymousFunction($index)
    {
        unset($this->anonymousFunction[$index]);
    }

    /**
     * Gets as anonymousFunction.
     *
     * @return TAnonymousFunctionExpressionType[]
     */
    public function getAnonymousFunction()
    {
        return $this->anonymousFunction;
    }

    /**
     * Sets a new anonymousFunction.
     *
     * @param  TAnonymousFunctionExpressionType[] $anonymousFunction
     * @return self
     */
    public function setAnonymousFunction(array $anonymousFunction)
    {
        $this->anonymousFunction = $anonymousFunction;
        return $this;
    }
}
