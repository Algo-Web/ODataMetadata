<?php


namespace AlgoWeb\ODataMetadata\Interfaces\Expressions;

/**
 * Interface IIfExpression
 *
 * Represents an EDM if expression.
 *
 * @package AlgoWeb\ODataMetadata\Interfaces\Expressions
 */
interface IIfExpression extends IExpression
{
    /**
     * @return IExpression Gets the test expression.
     */
    public function getTestExpression(): IExpression;

    /**
     * @return IExpression Gets the expression to evaluate if <see cref="TestExpression"/> evaluates to true.
     */
    public function getTrueExpression (): IExpression;

    /**
     * @return IExpression  Gets the expression to evaluate if <see cref="TestExpression"/> evaluates to false.
     */
    public function getFalseExpression(): IExpression;
}